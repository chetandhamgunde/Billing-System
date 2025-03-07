<?php
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->library('session');



     
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
    }

    // Handle user registration (saving to temp_users table)
    public function Register_user() {
        $name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));
        $password = $this->input->post('password');
        $confirmPassword = $this->input->post('confirmPassword');
        $mobile = trim($this->input->post('mobile'));
        

        if (empty($name) || !preg_match("/^[a-zA-Z\s]{3,50}$/", $name)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid name (only letters, min 3, max 50 characters)']);
            return;
        }
        
        // Validate Email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid email address']);
            return;
        }
        
        // Validate Password (Min 8 chars, at least 1 letter, 1 number, 1 special character)
        if (empty($password) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            echo json_encode(['status' => false, 'message' => 'Password must be at least 8 characters long and include 1 letter, 1 number, and 1 special character']);
            return;
        }
        
        if (empty($mobile) || !preg_match("/^[0-9]{10}$/", $mobile)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid 10-digit mobile number']);
            return;
        }
        

        if ($password !== $confirmPassword) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
            return;
        }

        // Check if email already exists in the users table
        if ($this->AuthModel->emailExists($email)) {
            echo json_encode(['success' => false, 'message' => 'Email is already taken.']);
            return;
        }

        if ($this->AuthModel->emailTempExists($email)) {
            echo json_encode(['success' => false, 'message' => 'Too many attempts you can register after 6 minutes of your registration time']);
            return;
        }

        // Generate OTP and store the data in temp_users table
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $otp = $this->generateOtp();
        $tempUserId = $this->AuthModel->registerTempUser($name, $email, $hashedPassword, $otp , $mobile);

        if ($tempUserId) {
            // Send OTP to email
            $this->sendOtpEmail($email, $otp);
            echo json_encode(['success' => true, 'message' => 'OTP sent to your email.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'There was an error registering your account.']);
        }
    }

    // Verify OTP and move data to the users table
    public function Verify_otp() {
        $email = trim($this->input->post('email'));
        $otp = trim($this->input->post('otp'));

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid email address']);
            return;
        }
        
        // Validate OTP (Only numbers, exactly 6 digits)
        if (empty($otp) || !preg_match("/^[0-9]{6}$/", $otp)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid 6-digit OTP']);
            return;
        }
    
        if ($this->AuthModel->verifyOtp($email, $otp)) {
            // Transfer data from temp_users to users table
            if ($this->AuthModel->moveToUserTable($email)) {
                echo json_encode(['success' => true, 'message' => 'OTP verified successfully. Your account is now active.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error activating your account.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }
    }
    

    // Generate a 6-digit OTP
    private function generateOtp() {
        return rand(100000, 999999);
    }

    // Send OTP to email
    private function sendOtpEmail($email, $otp) {
        // $config = array(
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_port' => 587,  // Use 587 for TLS
        //     'smtp_user' => 'shubhambhapkar0@gmail.com', 
        //     'smtp_pass' => 'uyzw dsth uiud einp',  // Use App Password instead of normal password
        //     'smtp_crypto' => 'tls',  // Change from 'ssl' to 'tls'
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'newline'   => "\r\n",
        //     'smtp_timeout' => '10', // Optional timeout
        //     'validation' => TRUE, // Validate email
        // );
        // $this->email->initialize($config);
        
        
        $this->email->from('shubhambhapkar0@gmail.com', 'Your App Name'); // Ensure the "From" email matches the SMTP user
        $this->email->to($email);
        $this->email->subject('Your OTP Code');
        $this->email->message("<p>Your OTP code is: <strong>$otp</strong></p>");
    
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger(); // Debugging output
            return false;
        }
    }

    public function resend_otp() {
        // Decode JSON input if sent as JSON
        $data = json_decode(file_get_contents("php://input"), true);
        $email = $data['email'] ?? null;
    
        // OR if you're using FormData, use:
        if (!$email) {
            $email = trim($this->input->post('email'));
        }
    
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid email address']);
            return;
        }
    
        // Debugging: Check if email is correctly received
        log_message('debug', 'Email received in resend_otp: ' . $email);
    
        if (!$this->AuthModel->emailTempExists($email)) {
            echo json_encode(['success' => false, 'message' => 'Email registration expired you need to register again.']);
            return;
        }
        date_default_timezone_set('Asia/Kolkata'); 
        $otp = rand(100000, 999999);
        $otp_expiry = date('Y-m-d H:i:s', strtotime('+2 minutes'));
    
        $this->db->where('email', $email);
        $this->db->update('temp_users', ['otp' => $otp, 'otp_expiry' => $otp_expiry, 'is_verified' => false]);
    
        if ($this->sendOtpEmail($email, $otp)) {
            echo json_encode(['success' => true, 'message' => 'OTP resent successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send OTP. Please try again.']);
        }
    }
    
    
    // from here controllers for the login start

    public function Login() {
        // Get data from the POST request
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');

     
        
        // Call your model's login validation function
        $result = $this->AuthModel->validate_login($username, $password);
    
        if ($result) {
            $this->session->set_userdata([
                'Logged_in' => true,
                'email' => $result->email,
                'id' => $result->id,
                'mobile' => $result->mobile,
                'name' => $result->name,
            ]);
            echo json_encode(['success' => true, 'message' => 'Login successful','info'=>$result]);
        

        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password' ]);
        }
    }
    
    public function Logout() {
        // Unset the session data related to login
        $this->session->unset_userdata('Logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id');
    
        // Destroy the session to completely log out
        $this->session->sess_destroy();
    
        // Redirect to login page or home page
        redirect('Home'); // Replace with the appropriate page you want to redirect to after logout
    }
    


    // forget password functionality


    public function Request_otp() {
        $email = trim($this->input->post('email'));

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid email address']);
            return;
        }

        if (!$this->AuthModel->emailExists($email)) {
            echo json_encode(['status' => false, 'message' => 'Email not registered']);
            return;
        }

        $otp = $this->generateOtp();
        $this->session->set_userdata('otp', $otp);
        $this->session->set_userdata('otp_email', $email);
        $this->session->set_userdata('otp_expiration', time() + 50);

        if ($this->sendOtpEmail($email, $otp)) {
            echo json_encode(['status' => true, 'message' => 'OTP sent successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to send OTP']);
        }
    }

    // Step 2: Verify OTP
    public function Verify_otp_forget() {
        $otp = $this->input->post('otp');

        if (empty($otp) || !preg_match("/^[0-9]{6}$/", $otp)) {
            echo json_encode(['status' => false, 'message' => 'Enter a valid 6-digit OTP']);
            return;
        }

        if ($this->session->userdata('otp') == $otp  && time() < $this->session->userdata('otp_expiration')  ) {
            echo json_encode(['status' => true, 'message' => 'OTP verified']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid or expired  OTP']);
        }
    }

    // Step 3: Reset Password
    public function Reset_password() {
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');
        $email = $this->session->userdata('otp_email');


        if (empty($new_password) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $new_password)) {
            echo json_encode(['status' => false, 'message' => 'Password must be at least 8 characters long and include 1 letter, 1 number, and 1 special character']);
            return;
        }

        if (empty($confirm_password) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $confirm_password)) {
            echo json_encode(['status' => false, 'message' => 'Password must be at least 8 characters long and include 1 letter, 1 number, and 1 special character']);
            return;
        }

        if (!$email) {
            echo json_encode(['status' => false, 'message' => 'Session expired. Request OTP again']);
            return;
        }

        if ($new_password !== $confirm_password) {
            echo json_encode(['status' => false, 'message' => 'Passwords do not match']);
            return;
        }

        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        if ($this->AuthModel->update_password($email, $hashed_password)) {
            $this->session->unset_userdata('otp');
            $this->session->unset_userdata('otp_email');
            echo json_encode(['status' => true, 'message' => 'Password updated successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to update password']);
        }
    }


    public function Check_login() {
       
        $response = ['logged_in' => false];

        if ($this->session->userdata('Logged_in')) {
            $response['logged_in'] = true;
        }

        echo json_encode($response);
    }

}
