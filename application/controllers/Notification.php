<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    public function Fetch() {
        $notifications = $this->Notification_model->get_unread_notifications();
        echo json_encode($notifications);
    }

    public function Mark_read($id) {
        $this->Notification_model->mark_as_read($id);
        echo json_encode(['status' => 'success']);
    }
}
?>
