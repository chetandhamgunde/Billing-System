<?php
class AuthModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }
    // Check if email already exists in the users table
    public function emailExists($email) {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->num_rows() > 0;
    }

    public function emailTempExists($email) {
        $query = $this->db->get_where('temp_users', ['email' => $email]);
        return $query->num_rows() > 0;
    }
    // Set to India Standard Time

    // Register user in the temp_users table
    // Register user in the temp_users table
public function registerTempUser($name, $email, $password, $otp,$mobile) {
    date_default_timezone_set('Asia/Kolkata'); 
    $data = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'otp' => $otp,
        'mobile' => $mobile,
        'otp_expiry' => date('Y-m-d H:i:s', strtotime('+2 minutes')) // Set expiry 5 mins from now
    ];
    $this->db->insert('temp_users', $data);
    return $this->db->insert_id();
}


    // Verify OTP from the temp_users table
   // Verify OTP from the temp_users table
public function verifyOtp($email, $otp) {
    date_default_timezone_set('Asia/Kolkata');  // Set to India Standard Time

    $this->db->where('email', $email);
    $this->db->where('otp', $otp);
    $this->db->where('is_verified', false);
    $this->db->where('otp_expiry >=', date('Y-m-d H:i:s')); // Check if OTP is not expired
    $query = $this->db->get('temp_users');

    if ($query->num_rows() > 0) {
        // Mark OTP as verified
        $this->db->update('temp_users', ['is_verified' => true], ['email' => $email]);
        return true;
    }
    return false;
}


    // Move data from temp_users to users table
    public function moveToUserTable($email) {
        // Get the user data from temp_users table
        $this->db->where('email', $email);
        $query = $this->db->get('temp_users');
        $user = $query->row_array();

        if ($user) {
            $data = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'mobile' => $user['mobile']
            ];

            // Insert into users table
            $this->db->insert('users', $data);

            // Delete from temp_users table
            $this->db->delete('temp_users', ['email' => $email]);

            return true;
        }
        return false;
    }




    // from here models for the login start


    public function validate_login($username, $password) {
        $this->db->select('*');
        $this->db->from('users');  // Replace 'users' with your actual table name
        $this->db->where('email', $username);
        
        $query = $this->db->get();
    
        if ($query->num_rows() == 1) {
            $user = $query->row();
    
            // Compare the entered password with the stored hashed password
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
    
        return false;
    }


    public function update_password($email, $password) {
        $this->db->where('email', $email);
        return $this->db->update('users', ['password' => $password]);
    }
    
}
