<?php
defined("BASEPATH") or exit("No direct script access allowed");

class CategoriesModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCategories()
    {
        $query = $this->db->get('categories');  
        return $query->result_array(); 
    }

}
?>
