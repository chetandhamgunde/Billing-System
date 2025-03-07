<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProfile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');  // Load UserModel
        $this->load->library('session');
        $this->load->library('form_validation');  // Load form validation library
        
        if (!$this->session->userdata('Logged_in')) {
            redirect(base_url('Home')); 
        }

    }

    public function Profile() {
        $this->load->view('User/userprofile');
    }

    public function History() {
        $this->load->view('User/userhistory');
    }

    public function Booking() {
        $this->load->view('User/userbookings');
    }

    // Get the data of the logged-in user
    public function GetUserInfo() {
        // Retrieve the logged-in user's ID from the session
        $userId = $this->session->userdata('id');

        if ($userId) {
            // Fetch user details using the model
            $userDetails = $this->UserModel->getUserDetails($userId);

            if ($userDetails) {
                // Return the user details as a JSON response
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User details retrieved successfully.',
                    'data' => $userDetails
                ]);
            } else {
                // Return a JSON response for user not found
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User not found.'
                ]);
            }
        } else {
            // Return a JSON response for user not logged in
            echo json_encode([
                'status' => 'error',
                'message' => 'User is not logged in.'
            ]);
        }
    }

    public function UpdateProfileImage() {
        // Check if the user is logged in
        $userId = $this->session->userdata('id');
        if (!$userId) {
            // Redirect to login page if the user is not logged in
            redirect('login');
        }

        // Load necessary libraries
        $this->load->library('upload');
        
        // Get the user's current image filename (if exists)
        $userDetails = $this->UserModel->getUserDetails($userId);
        $oldImage = $userDetails['image'];  // Assuming 'image' is the column storing the image filename

        // Check if the file is uploaded
        if (isset($_FILES['editImage']) && !empty($_FILES['editImage']['name'])) {
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 10240;  // Max file size 10MB
            $config['file_name'] = 'profile_' . time();  // Add timestamp to avoid name conflicts
        
            $this->upload->initialize($config);
        
            if ($this->upload->do_upload('editImage')) {
                $image_data = $this->upload->data();
                $newImage = $image_data['file_name'];
        
                // Delete the old image if it exists and is different from the new one
                if ($oldImage && file_exists('./uploads/images/' . $oldImage)) {
                    unlink('./uploads/images/' . $oldImage);
                }
        
                // Update the database with the new image
                $this->UserModel->updateUserImage($userId, $newImage);
        
                // Return success response
                echo json_encode(['status' => 'success', 'message' => 'Profile image updated successfully']);
            } else {
                // If upload fails, return error message
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            }
        } else {
            // If no file uploaded, return error
            echo json_encode(['status' => 'error', 'message' => 'No image file uploaded']);
        }
    }

    public function UpdateProfile() {
        // Check if the request is a POST request
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        // Decode the incoming JSON data
        $postData = json_decode(file_get_contents("php://input"), true);

        // Set validation rules
        $this->form_validation->set_data($postData);
        $this->form_validation->set_rules('fullName', 'Full Name', 'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]', ['regex_match' => 'Mobile number must be 10 digits']);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('location', 'Location', 'max_length[100]');

        // Validate the input
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }

        // Get the logged-in user ID from the session
        $userId = $this->session->userdata('id');
        if (!$userId) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        // Prepare data for update
        $updateData = [
            'name' => $postData['fullName'],
            'mobile' => $postData['mobile'],
            'email' => $postData['email'],
            'location' => !empty($postData['location']) ? $postData['location'] : null
        ];

        // Update user profile in the database
        if ($this->UserModel->updateUserProfile($userId, $updateData)) {
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
        }
    }

    public function ChangePassword() {
        // Get user ID from session
        $userId = $this->session->userdata('id');
        
        if (!$userId) {
            // If user is not logged in, return error response
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        // Get the JSON input data
        $jsonData = json_decode($this->input->raw_input_stream, true);

        // Manually set the POST data for form validation
        $_POST['currentPassword'] = $jsonData['currentPassword'];
        $_POST['newPassword'] = $jsonData['newPassword'];
        $_POST['confirmPassword'] = $jsonData['confirmPassword'];

        // Set form validation rules
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required');
        $this->form_validation->set_rules('newPassword', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]');

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, return validation errors in JSON format
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        } else {
            // If validation passes, proceed with password change

            // Get input values
            $currentPassword = $jsonData['currentPassword'];
            $newPassword = $jsonData['newPassword']; 
            $confirmPassword = $jsonData['confirmPassword'];

            // Fetch current password from the database
            $userDetails = $this->UserModel->getUserDetails($userId);
            $dbPassword = $userDetails['password']; // Assuming 'password' is the column for storing hashed passwords

            // Verify the current password with the one in the database using password_verify
            if (password_verify($currentPassword, $dbPassword)) {
                // Hash the new password using password_hash
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Update the password in the database
                $updateData = ['password' => $hashedPassword];
                $this->UserModel->updateUserPassword($userId, $updateData);

                // Provide success response
                echo json_encode(['status' => 'success', 'message' => 'Password updated successfully!']);
            } else {
                // If current password does not match
                echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
            }
        }
    }
}
