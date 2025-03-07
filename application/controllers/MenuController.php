<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Load the MenuModel
        $this->load->model('MenuModel');
        // Load the upload library
        $this->load->library('upload');
    }

    // Add Menu
    public function AddMenu()
    {
        // Form data
        $formdata = $this->input->post();

        // Set upload configurations
        $uploadPath = './uploads/menu/';
        $originalFileName = $_FILES['image']['name'];
        $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $fileBaseName = pathinfo($originalFileName, PATHINFO_FILENAME);

        // Always generate a unique name using timestamp
        $newFileName = $fileBaseName . '_' . time() . '.' . $fileExt;
        $filePath = $uploadPath . $newFileName;

        // Set upload configurations
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;  // Max file size (2MB)
        $config['file_name'] = $newFileName;

        // Initialize upload library with the configuration
        $this->upload->initialize($config);

        // Check if the file is uploaded successfully
        if ($this->upload->do_upload('image')) {
            // Get uploaded file data
            $uploadData = $this->upload->data();

            // Add the image filename to the form data
            $formdata['image'] = $uploadData['file_name'];

            // Call the Add_Menu function to save data in the database
            if ($this->MenuModel->Add_Menu($formdata)) {
                $this->session->set_flashdata('success', 'Menu item added successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to add menu item.');
            }

            return redirect('menus');
        } else {
            // If upload fails, store error message in flashdata
            $this->session->set_flashdata('error', $this->upload->display_errors());
            return redirect('menus');
        }
    }

    // Edit menu item
    public function EditMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->MenuModel->getMenuById($id);

        if (!$menu) {
            $this->session->set_flashdata('error', 'Menu item not found.');
            return redirect('menus');
        }

        // Get form data
        $formdata = $this->input->post();

        // Check if a new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            // Set upload configurations
            $uploadPath = './uploads/menu/';
            $originalFileName = $_FILES['image']['name'];
            $fileExt = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $fileBaseName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $newFileName = $fileBaseName . '_' . time() . '.' . $fileExt;

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = $newFileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                // Delete old image if exists
                $oldImagePath = $uploadPath . $menu['image'];
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);  // Remove the old image
                }

                // Get the uploaded file details
                $uploadData = $this->upload->data();
                $formdata['image'] = $uploadData['file_name']; // Set the new image file name
            } else {
                // If image upload fails, show error message
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect('menus');
            }
        } else {
            // If no new image is uploaded, retain the previous image
            $formdata['image'] = $menu['image']; // Use the previous image
        }

        // Update menu item in the database
        if ($this->MenuModel->updateMenu($id, $formdata)) {
            $this->session->set_flashdata('success', 'Menu item updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update menu item.');
        }

        return redirect('menus');
    }


    // Delete menu item
    public function DeleteMenu($id)
    {
        
        if ($this->MenuModel->deleteMenu($id)) {
            $this->session->set_flashdata('success', 'Menu item deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete menu item.');
        }
        return redirect('menus');
    }

    public function GetSingleMenu()
    {
        $id = $this->input->post('id'); // Get the ID from the request

        if (!$id) {
            $response = ['success' => false, 'message' => 'Invalid menu ID'];
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400) // Bad Request
                ->set_output(json_encode($response));
            return;
        }

        $menu = $this->MenuModel->getMenuById($id); // Fetch the menu item

        if ($menu) {
            $response = ['success' => true, 'data' => $menu];
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200) // OK
                ->set_output(json_encode($response));
        } else {
            $response = ['success' => false, 'message' => 'Menu item not found'];
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(404) // Not Found
                ->set_output(json_encode($response));
        }
    }

    // add category
    public function AddCategory() {
        // Get the JSON input
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate input
        if (empty($data['categoryName'])) {
            echo json_encode(['status' => 'error', 'message' => 'Category name is required']);
            return;
        }

        // Check if the category already exists
        if ($this->MenuModel->categoryExists($data['categoryName'])) {
            echo json_encode(['status' => 'exists', 'message' => 'Category already exists']);
            return;
        }

        // Insert the new category
        $inserted = $this->MenuModel->addCategory($data['categoryName']);
        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Category added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add category']);
        }
    }

    public function DeleteCategory() {
        // Get the JSON input
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Validate input
        if (empty($data['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Category ID is required']);
            return;
        }
    
        // Attempt to delete the category
        if ($this->MenuModel->deleteCategory($data['id'])) {
            echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete category']);
        }
    }


    public function EditCategory() {
        // Set the response header to return JSON
        header('Content-Type: application/json');
    
        // Retrieve raw POST data and decode the JSON payload
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Extract id and name from the decoded data
        $id   = isset($data['id']) ? $data['id'] : null;
        $name = isset($data['name']) ? $data['name'] : null;
    
        // Validate the inputs
        if (empty($id) || empty($name)) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Invalid input. Category ID and name are required.'
            ]);
            return;
        }

    
        // Attempt to update the category
        if ($this->MenuModel->EditCategory($id, $name)) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Category updated successfully.'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Failed to update category. Please try again.'
            ]);
        }
    }
    
    
}
