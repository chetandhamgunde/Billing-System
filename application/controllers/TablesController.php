<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TablesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tables');
    }

    public function GetAreas() {
        $areas = $this->Tables->getAllAreas();
        echo json_encode($areas);  // Return areas as JSON response
    }


    public function AddTable() {
        $tableNo = $this->input->post('tableNo');
        $capacity = $this->input->post('capacity');
        $section = $this->input->post('section');
    
        if (empty($capacity) || empty($section)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            return;
        }
    
        // Get area details
        $area = $this->Tables->getAreaByName($section);
        if (!$area) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid section selected.']);
            return;
        }
    
        // Format the table number (e.g., G-1 for Garden)
        $tableNoFormatted = strtoupper(substr($section, 0, 1)) . '-' . $tableNo;
    
        // Check if the table number already exists
        if ($this->Tables->isTableNumberExists($tableNoFormatted)) {
            echo json_encode(['status' => 'error', 'message' => 'Table number already exists.']);
            return;
        }
    
        // Insert table data
        $data = [
            'table_number' => $tableNoFormatted,
            'seats' => $capacity,
            'area_id' => $area['id']
        ];
    
        if ($this->Tables->insertTable($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Table added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add table.']);
        }
    }


    public function GetAllTables()
    {
        // Fetch tables with areas
        $tables = $this->Tables->get_tables_with_areas();
    
        if (!empty($tables)) {
            $response = [
                'status' => "success",
                'message' => 'Tables retrieved successfully.',
                'data' => $tables
            ];
            $status_code = 200; // HTTP OK
        } else {
            $response = [
                'status' => "error",
                'message' => 'No tables found.',
                'data' => []
            ];
            $status_code = 404; // HTTP Not Found
        }
    
        // Return JSON response with proper HTTP status code
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(json_encode($response, JSON_PRETTY_PRINT));
    }

    public function Get_table_by_Id($id) {
        $table = $this->Tables->getTableById($id);
        if ($table) {
            echo json_encode(['status' => 'success', 'data' => $table]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Table not found']);
        }
    }

    public function Update_table($tableId) {
        $tableId = $this->input->post('tableId');
        $tableNo = $this->input->post('tableNo');
        $capacity = $this->input->post('capacity');
    
        // Check if the table number exists but allow update if it's the same ID
        if ($this->Tables->isTableNumberExistsID($tableNo, $tableId)) {
            echo json_encode(['status' => 'error', 'message' => 'Table number already exists.']);
            return;
        }
    
        // Update the table record
        $updateData = [
            'table_number' => $tableNo,
            'seats' => $capacity
        ];
        $this->db->where('id', $tableId);
        $updated = $this->db->update('tables', $updateData);
    
        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Table updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update table.']);
        }
    }


    public function DeleteTable() {
        $table_id = $this->input->post('table_id');

        if ($this->Tables->deleteTable($table_id)) {
            echo json_encode(['status' => true, 'message' => 'Table deleted successfully!']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to delete the table!']);
        }
    }
    

 
    
}
