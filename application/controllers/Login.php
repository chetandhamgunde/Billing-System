<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
       
            if ($this->session->userdata('Logged_in')) {
                redirect(base_url('Home')); 
            }
   
    }
    // Redirect to home if already logged in
    
        public function Login(){
            $this->load->view('User/Login');
        }
    
        public function Forget(){
            $this->load->view('User/forget');
        }
    
        public function Register(){
            $this->load->view('User/register');
        }
    


}