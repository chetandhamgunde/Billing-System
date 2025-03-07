<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tables extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function getAllAreas() {
        $query = $this->db->get('areas');
        return $query->result_array();  // Return all rows as an array
    }

    public function isTableNumberExists($tableNo) {
        $this->db->where('table_number', $tableNo);
        $query = $this->db->get('tables');
        return $query->num_rows() > 0;
    }

    public function getAreaByName($name) {
        $query = $this->db->get_where('areas', ['name' => $name]);
        return $query->row_array();
    }

    public function insertTable($data) {
        return $this->db->insert('tables', $data);
    }


    public function getAllTables() {
        $this->db->where('deleted_at', NULL); // Ignore soft deleted rows
        $query = $this->db->get('tables');
        return $query->result_array();  
    }
    

    public function get_tables_with_areas() {
        $this->db->select('tables.*, areas.name as area_name');
        $this->db->from('tables');
        $this->db->join('areas', 'areas.id = tables.area_id', 'left');
        $this->db->where('tables.deleted_at', NULL); // Ignore deleted tables
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function getTableById($id) {
        return $this->db->where('id', $id)->get('tables')->row_array();
    }


    public function updateTable($tableId, $data)
    {
        $this->db->where('id', $tableId);
        return $this->db->update('tables', $data);
    }


    public function isTableNumberExistsID($tableNo, $tableId) {
        $this->db->where('table_number', $tableNo);
        $this->db->where('id !=', $tableId);  // Exclude the current table ID
        $query = $this->db->get('tables');
        
        return $query->num_rows() > 0;
    }

    public function deleteTable($table_id) {
        $this->db->where('id', $table_id);
        return $this->db->update('tables', ['deleted_at' => date('Y-m-d H:i:s')]); 
    }
    
    





    
}
