<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function get_unread_notifications() {
        $this->db->where('status', 'unread');
        $query = $this->db->get('notifications');
        return $query->result_array();
    }

    public function mark_as_read($id) {
        $this->db->where('id', $id);
        return $this->db->update('notifications', ['status' => 'read']);
    }
}
?>
