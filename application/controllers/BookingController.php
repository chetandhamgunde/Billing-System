<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->model('BookingModel');
        $this->load->model('UserModel');
        
         // Check if the user is logged in and if the username is 'shubh'
        // if (!$this->session->userdata('Logged_in') || $this->session->userdata('email') !== 'shubhambhapkar0@gmail.com'){
        //         redirect('login');
    }

    public function GetAvailableTables()
    {
        $booking_date = $this->input->get('booking_date');
        $start_time = $this->input->get('start_time');
        $end_time = $this->input->get('end_time');

        // var_dump($booking_date,$start_time,$end_time);die;

        // Validate input parameters
        if (empty($booking_date) || empty($start_time) || empty($end_time)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing required parameters']));
        }

        $available_tables = $this->BookingModel->GetTablesWithStatus($booking_date, $start_time, $end_time);
        // var_dump($available_tables);die;
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['status' => 'success', 'available_tables' => $available_tables]));
    }

   
    

    //create booking
    public function CreateBooking() {
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Get user ID from session
        $user_id = $this->session->userdata('id');
    
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }
    
        $booking_date = $data['booking_date']; 
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $selected_tables = $data['tables']; // Array of table IDs
        $guests = $data['guests'];
        $special_request = $data['special_request'];
    
        // Call the model function to create the booking
        $result = $this->BookingModel->createBooking($user_id, $booking_date, $start_time, $end_time, $selected_tables, $guests, $special_request);
    
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Booking successful!']);
            
            // Send emails in the background after sending the response
            $this->_sendBookingEmails($user_id, $booking_date, $start_time, $end_time, $selected_tables, $guests, $special_request);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Booking failed.']);
        }
    }
    
    // Private function to send emails to admin and user
    private function _sendBookingEmails($user_id, $booking_date, $start_time, $end_time, $selected_tables, $guests, $special_request) {
       
    
        // Fetch user details
        $user_info = $this->UserModel->getUserDetails($user_id); 
    
        // Email to Admin
        $admin_subject = "New Booking Received";
        $admin_message = "
            <p>Dear Admin,</p>
            <p>A new booking has been made by <strong>{$user_info['name']} ({$user_info['email']})</strong>.</p>
            <p><strong>Booking Details:</strong></p>
            <ul>
                <li><strong>Date:</strong> {$booking_date}</li>
                <li><strong>Time:</strong> {$start_time} to {$end_time}</li>
                <li><strong>Guests:</strong> {$guests}</li>
                <li><strong>Special Request:</strong> {$special_request}</li>
                <li><strong>Selected Tables:</strong> " . implode(', ', $selected_tables) . "</li>
            </ul>
            <p>Thank you.</p>
        ";
    
        $this->email->from($user_info['email'], $user_info['name']);
        $this->email->to('shubhambhapkar0@gmail.com');  // Replace with admin's email
        $this->email->subject($admin_subject);
        $this->email->message($admin_message);
        $this->email->set_mailtype('html');
        $this->email->send();
    
        // Email to User
        $user_subject = "Booking Confirmation";
        $user_message = "
            <p>Dear {$user_info['name']},</p>
            <p>Thank you for your booking. Here are your booking details:</p>
            <ul>
                <li><strong>Date:</strong> {$booking_date}</li>
                <li><strong>Time:</strong> {$start_time} to {$end_time}</li>
                <li><strong>Guests:</strong> {$guests}</li>
                <li><strong>Special Request:</strong> {$special_request}</li>
                <li><strong>Selected Tables:</strong> " . implode(', ', $selected_tables) . "</li>
            </ul>
            <p>We look forward to serving you!</p>
            <p>Best Regards,<br>Hari-om-dhaba</p>
        ";
    
        $this->email->from('shubhambhapkar0@gmail.com', 'Hari-om-Dhaba');
        $this->email->to($user_info['email']);
        $this->email->subject($user_subject);
        $this->email->message($user_message);
        $this->email->set_mailtype('html');
        $this->email->send();
    }
    

    public function GetBookingData() {
        $this->load->model('BookingModel');
        $bookings = $this->BookingModel->getBookingData();
    
        $formattedBookings = array_map(function($booking) {
            return [
                'id' => $booking['id'],
                'customer_name' => $booking['customer_name'],
                'contact' => $booking['mobile'],
                'booking_time' => $booking['booking_time'],
                'guests' => $booking['guests'],
                'special_request' => $booking['special_request'],
                'table_no' => $booking['table_no'],
                'status' => strtolower($booking['status']),
                'start_time' => $booking['start_time'],
                'end_time' => $booking['end_time']
            ];
        }, $bookings);
    
        echo json_encode($formattedBookings);
    }


    // approve the booking
    public function ApproveBooking() {
        $data = json_decode(file_get_contents('php://input'), true);
        $booking_id = $data['id'];
        $status = $data['status'];
    
        if (!$booking_id) {
            echo json_encode(['status' => 'error', 'message' => 'Booking ID is required.']);
            return;
        }
    
        $this->load->model('BookingModel');
        $booking = $this->BookingModel->getBookingById($booking_id);
    
        if ($booking) {
            $isUpdated = $this->BookingModel->updateBookingStatus($booking_id, $status);
    
            if ($isUpdated) {
                if ($status === 'approved'  || $status === 'cancel') {
                    $this->sendStatusEmailToUser($booking['user_id'], $status);  // Send email after updating the status
                }
              
                echo json_encode(['status' => 'success', 'message' => 'Booking approved successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to approve the booking.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Booking not found.']);
        }
    }
    
   private function sendStatusEmailToUser($user_id, $status) {
    $this->load->model('UserModel');
    $user = $this->UserModel->getUserDetails($user_id);  // Fetch user details using user_id

    if ($user) {
        $to = $user['email'];
        $subject = "Booking Status Update";
        $message = "Dear " . $user['name'] . ",\n\nYour booking status has been updated to: " . strtoupper($status) . ".\n\nThank you for choosing us!";
        
        // Send email to the user
        $this->email->from('shubhambhapkar0@gmail.com', 'Hari-om-Dhaba');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype('html');
        $this->email->send();

        // If status is "cancel", send a notification email to the admin
        // if (strtolower($status) === 'cancel') {
        //     $this->sendCancelNotificationToAdmin($user['name'], $user['email']);
        // }
    }
}

// private function sendCancelNotificationToAdmin($user_name, $user_email) {
//     $admin_email = 'admin@hari-om-dhaba.com';  // Replace with the actual admin email
//     $subject = "Booking Cancellation Notification";
//     $message = "Hello Admin,\n\nThe following booking has been canceled:\n\n" .
//                "User Name: " . $user_name . "\n" .
//                "User Email: " . $user_email . "\n\n" .
//                "Please take necessary action.\n\nThank you.";

//     $this->email->from('shubhambhapkar0@gmail.com', 'Hari-om-Dhaba');
//     $this->email->to($admin_email);
//     $this->email->subject($subject);
//     $this->email->message(nl2br($message));
//     $this->email->set_mailtype('html');
//     $this->email->send();
// }

    


    // delete the booking
    public function deleteBooking() {
        $data = json_decode(file_get_contents('php://input'), true);
        $booking_id = $data['id'];
    
        if (!$booking_id) {
            echo json_encode(['status' => 'error', 'message' => 'Booking ID is required.']);
            return;
        }
    
        $this->load->model('BookingModel');
        $booking = $this->BookingModel->getBookingById($booking_id);
    
        if ($booking) {
            $isDeleted = $this->BookingModel->deleteBookingById($booking_id);
    
            if ($isDeleted) {
                echo json_encode(['status' => 'success', 'message' => 'Booking deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete the booking.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Booking not found.']);
        }
    }
    

    

    public function GetBookings() {
        $user_id = $this->session->userdata('id'); // Get user ID from session
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        $bookings = $this->BookingModel->getUserBookings($user_id);

        if (!empty($bookings)) {
            echo json_encode(['status' => 'success', 'data' => $bookings]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No bookings found']);
        }
    }


    public function SubmitFeedback() {
        header('Content-Type: application/json');

        // Check if the user is logged in
        $user_id = $this->session->userdata('id');
        if (!$user_id) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $rating = isset($input['rating']) ? intval($input['rating']) : null;
        $comments = isset($input['comments']) ? trim($input['comments']) : '';

        if (!$rating || empty($comments)) {
            echo json_encode(['status' => 'error', 'message' => 'Both rating and comments are required.']);
            return;
        }

        // Save feedback in the database
        $feedbackData = [
            'user_id' => $user_id,
            'comment' => $comments,
            'rating' => $rating
        ];

        $insert_id = $this->BookingModel->saveFeedback($feedbackData);
        if ($insert_id) {
            echo json_encode(['status' => 'success', 'message' => 'Feedback submitted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit feedback.']);
        }
    }

    public function GetCounts() {
        $this->load->model('OfferModel'); // Load the model
        $data = $this->OfferModel->get_counts(); // Fetch data from the model
        echo json_encode(['status' => 'success', 'data' => $data]); // Send JSON response
    }


    public function GetMenuCounts() {
        $data = $this->MenuModel->get_menu_counts();

        // Return JSON response
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function GetBookingCounts() {
        // Fetch data from the model
        $data = [
            'pending'            => $this->BookingModel->getBookingCountByStatus('pending'),
            'approved'           => $this->BookingModel->getBookingCountByStatus('approved'),
            'cancelled'          => $this->BookingModel->getBookingCountByStatus('cancel'),
            'completed'          => $this->BookingModel->getBookingCountByStatus('completed'),

            'completed_weekly'   => $this->BookingModel->getBookingCountByStatus('completed', 'weekly'),
            'cancelled_weekly'   => $this->BookingModel->getBookingCountByStatus('cancel', 'weekly'),

            'completed_monthly'  => $this->BookingModel->getBookingCountByStatus('completed', 'monthly'),
            'cancelled_monthly'  => $this->BookingModel->getBookingCountByStatus('cancel', 'monthly'),
        ];

        // Return response in JSON format
        echo json_encode([
            'status' => 'success',
            'data'   => $data
        ]);
    }
    
    

}