<?php
defined("BASEPATH")or exit("No direct script access allowed");

class UserModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();    
    }

    function AddUser($userdata)
    {
      
        $this->db->insert("user",$userdata);
    }

    function GetUserData()
    {
        $users=$this->db->get("user")->result();
        print_r($users);
    }

    public function getUserDetails($userId) {
        $this->db->where('id', $userId);  // 'id' should match your table's primary key
        $query = $this->db->get('users'); // 'users' is the table name
        return $query->row_array();       // Return the result as an associative array
    }

    public function updateUserImage($userId, $newImage)
{
    // Update the user's image path in the database
    $data = ['image' => $newImage];
    $this->db->where('id', $userId);
    $this->db->update('users', $data);  // Assuming your users table is named 'users'
}


public function updateUserProfile($userId, $data) {
    $this->db->where('id', $userId);
    return $this->db->update('users', $data);  // Assuming your table is 'users'
}
public function updateUserPassword($userId, $updateData) {
    $this->db->where('id', $userId);
    return $this->db->update('users', $updateData);
}
}



?>