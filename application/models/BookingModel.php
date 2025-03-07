<?php
defined("BASEPATH") or exit("No direct script access allowed");

class BookingModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // GIVES ONLY FREE TABLES
    public function GetAvailableTables($booking_date, $start_time, $end_time)
    {
        $query = "SELECT * FROM tables t
                  WHERE t.id NOT IN (
                      SELECT bd.table_id 
                      FROM bookings b
                      JOIN booking_details bd ON b.id = bd.booking_id
                      WHERE b.booking_date = ? 
                      AND (b.start_time < ? AND b.end_time > ?)
                  )";

        return $this->db->query($query, [$booking_date, $end_time, $start_time])->result();
    }

    // GIVES ALL TABLES WITH STATUS(available,booked)
    public function GetTablesWithStatus($booking_date, $start_time, $end_time)
    {
        $query = "SELECT t.*, 
                     CASE 
                         WHEN bd.table_id IS NOT NULL THEN 'booked' 
                         ELSE 'available' 
                     END AS status
              FROM tables t
              LEFT JOIN (
                  SELECT bd.table_id 
                  FROM bookings b
                  JOIN booking_details bd ON b.id = bd.booking_id
                  WHERE b.booking_date = ? 
                  AND (b.start_time < ? AND b.end_time > ?)
              ) AS bd ON t.id = bd.table_id
              WHERE t.deleted_at IS NULL";

        return $this->db->query($query, [$booking_date, $end_time, $start_time])->result();
    }




    public function createBooking($user_id, $booking_date, $start_time, $end_time, $selected_tables, $guests, $special_request)
    {
        $this->db->trans_start();
    
        // Insert booking into 'bookings' table
        $bookingData = [
            'user_id' => $user_id,
            'booking_date' => $booking_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'guests' => $guests,
            'special_request' => $special_request,
            'status' => 'pending'
        ];
        $this->db->insert('bookings', $bookingData);
        $booking_id = $this->db->insert_id();
    
        // Store table numbers
        $tableNumbers = [];
    
        // Insert each table into 'booking_details' table
        foreach ($selected_tables as $table_id) {
            $this->db->insert('booking_details', [
                'booking_id' => $booking_id,
                'table_id' => $table_id
            ]);
            
            // Fetch the table number based on table_id
            $query = $this->db->select('table_number')
                              ->from('tables') // Assuming your table name is 'tables'
                              ->where('id', $table_id)
                              ->get();
            $result = $query->row();
    
            if ($result) {
                $tableNumbers[] = $result->table_number;
            }
        }
    
        // Convert table numbers to a string
        $tableNumberText = implode(', ', $tableNumbers);
    
        // Insert notification into 'notifications' table
        $message = "New booking #$booking_id has been created for $booking_date from $start_time to $end_time for table $tableNumberText.";
        $notificationData = [
            'message' => $message,
            'status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('notifications', $notificationData);
    
        $this->db->trans_complete();
    
        // Check the transaction status and return the result
        return $this->db->trans_status();
    }
    
    //get booking data
    public function getBookingData()
    {
        $this->db->select('b.id, u.name as customer_name, u.mobile, 
        CONCAT(b.booking_date, " ", b.start_time) as booking_time, 
        b.guests, b.start_time, b.end_time, b.special_request, 
        COALESCE(GROUP_CONCAT(t.table_number SEPARATOR ","), "No Table Assigned") as table_no, 
        b.status');
    $this->db->from('bookings b');
    $this->db->join('users u', 'b.user_id = u.id'); 
    $this->db->join('booking_details bd', 'b.id = bd.booking_id', 'left');  // LEFT JOIN to include all bookings
    $this->db->join('tables t', 'bd.table_id = t.id', 'left');  // LEFT JOIN to include bookings without tables
    $this->db->group_by('b.id');
    
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getBookingById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('bookings');
        return $query->row_array(); // Return a single row as an associative array
    }

    public function updateBookingStatus($id, $status, $table_number = null)
{
    $this->db->trans_start();

    // Update booking status and table number (if provided)
    $updateData = ['status' => $status];
    if (!is_null($table_number)) {
        $updateData['table_number'] = $table_number;
    }

    $this->db->where('id', $id);
    $update = $this->db->update('bookings', $updateData);

    if ($update) {
        // Fetch assigned table numbers if no table_number is directly provided
        if (is_null($table_number)) {
            $query = $this->db->select('t.table_number')
                              ->from('booking_details bd')
                              ->join('tables t', 'bd.table_id = t.id')
                              ->where('bd.booking_id', $id)
                              ->get();
            $results = $query->result();
            $tableNumbers = array_map(fn($row) => $row->table_number, $results);
            $table_number = implode(', ', $tableNumbers);
        }

        // Insert notification into 'notifications' table
        $message = "Booking #$id status has been updated to " . ucfirst($status) . ".";
        if (!empty($table_number)) {
            $message .= " Assigned Table Number(s): $table_number.";
        }

        $notificationData = [
            'message' => $message,
            'status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('notifications', $notificationData);

        // If the booking is canceled, delete related entries from booking_details table
        if (strtolower($status) === 'cancel') {
            $this->db->where('booking_id', $id);
            $this->db->delete('booking_details');
        }
    }

    $this->db->trans_complete();

    return $this->db->trans_status();
}

    public function deleteBookingById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bookings');
    }

    public function getUserBookings($user_id)
    {
        $this->db->select('b.id, b.booking_date, b.start_time, b.end_time, b.guests, b.special_request, b.status, 
                                GROUP_CONCAT(t.table_number) as table_numbers');
        $this->db->from('bookings b');
        $this->db->join('booking_details bd', 'bd.booking_id = b.id', 'left');
        $this->db->join('tables t', 't.id = bd.table_id', 'left'); // Join with tables to get table_number
        $this->db->where('b.user_id', $user_id);
        $this->db->group_by('b.id'); // Group by booking ID to combine related tables
        $this->db->order_by('b.created_at', 'DESC');
        return $this->db->get()->result_array();
    }


    public function saveFeedback($data)
    {
        return $this->db->insert('feedback', $data) ? $this->db->insert_id() : false;
    }

    public function getBookingCountByStatus($status, $filter = null)
    {
        $this->db->where('status', $status); // Filter by status

        if ($filter === 'weekly') {
            $this->db->where('DATE(created_at) >=', date('Y-m-d', strtotime('-7 days')));
        } elseif ($filter === 'monthly') {
            $this->db->where('DATE(created_at) >=', date('Y-m-01'));
        } else {
            $this->db->where('DATE(created_at)', date('Y-m-d')); // Filter bookings for today
        }

        return $this->db->count_all_results('bookings'); // Count matching rows in 'bookings' table
    }
}
