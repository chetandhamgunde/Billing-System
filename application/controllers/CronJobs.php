<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CronJobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

    public function auto_cancel_expired_bookings()
    {
        // Update expired bookings
        $this->db->query("UPDATE bookings 
                          SET status = 'cancel' 
                          WHERE status = 'pending' 
                          AND CONCAT(booking_date, ' ', start_time) < NOW()");

        // Corrected DELETE query using alias for MySQL compatibility
        $this->db->query("DELETE bd 
                          FROM booking_details AS bd 
                          INNER JOIN bookings AS b ON bd.booking_id = b.id
                          WHERE b.status = 'cancel'");

        log_message('info', 'Expired bookings canceled successfully.');
        echo "Expired bookings canceled successfully.";
    }

    public function delete_expired_offers()
    {
        $this->db->query("DELETE FROM offers WHERE validUpto < NOW()");
        log_message('info', 'Expired offers deleted.');
        echo "Expired offers deleted.";
    }

    public function delete_expired_otps()
    {
        $this->db->query("DELETE FROM temp_users WHERE record_expiry < NOW()");
        log_message('info', 'Expired OTPs deleted.');
        echo "Expired OTPs deleted.";
    }

    public function update_completed_bookings()
    {
        $this->db->query("UPDATE bookings 
                          SET status = 'completed' 
                          WHERE status = 'approved' 
                          AND CONCAT(booking_date, ' ', end_time) < NOW()");

        log_message('info', 'Completed bookings updated.');
        echo "Completed bookings updated.";
    }
}
