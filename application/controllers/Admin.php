<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->library('session');
        $this->load->model('OfferModel');
        $this->load->model('UserModel');
        $this->load->model('MenuModel');
        $this->load->model('Tables');
        $this->load->model('BookingModel');
        $this->load->library('form_validation');
        $this->load->library('upload');

        // Check if the user is logged in and if the username is 'shubh'
        if (!$this->session->userdata('Logged_in') || $this->session->userdata('email') !== 'shubhambhapkar0@gmail.com'){
       
            redirect('login');
        }
    }
	

    public function Dashboard(){
        $this->load->view('Admin/Dashboard');
    }
	public function Bookings(){
        $this->load->view('Admin/Bookings');
    }
	public function Menus(){
        // Load the CategoryModel
        $this->load->model('CategoriesModel');
 
        // Fetch all categories
        $data['categories'] = $this->CategoriesModel->getCategories();

    
        // Fetch all menus
        $data['menus'] = $this->MenuModel->getAllMenus();
        $this->load->view('Admin/Menus',$data);
    }
   
    public function Offers(){
        $this->load->view('Admin/Offers');
    }
    public function Bill(){
        // Fetch all menus
        $data['menus'] = $this->MenuModel->getAllMenus();
        $data['tables'] = $this->Tables->getAllTables();
        $this->load->view('Admin/PrintBill',$data);
    }
    public function Profile(){
        $this->load->view('Admin/Profile');
    }
    public function Gallery(){
        $this->load->view('Admin/Gallery');
    }
    public function Report(){
        $this->load->view('Admin/Report');
    }
   





    // for the submission of the offer 

    // offer input
    public function Add_offer() {
        // Validate form inputs
        $this->form_validation->set_rules('offerName', 'Offer Name', 'required');
        $this->form_validation->set_rules('offerDesc', 'Description', 'required');
        $this->form_validation->set_rules('validUpto', 'Valid Upto', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('discount', 'Discount', 'required|numeric|greater_than[0]|less_than[101]');

        if ($this->form_validation->run() == FALSE) {
            // Form validation failed
            $response = [
                'status' => 'error',
                'message' => validation_errors()
            ];
            echo json_encode($response);
            return;
        } else {
            // Handle file upload
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 10240; // 10MB max size
            $config['file_name'] = 'offer_' . time(); // Add timestamp to avoid duplicates
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('newOfferImage')) {
                // Upload failed
                $response = [
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                ];
                echo json_encode($response);
                return;
            } else {
                // Upload successful, get image data
                $image_data = $this->upload->data();
                $image_path = $image_data['file_name'];

                // Prepare offer data
                $offer_data = [
                    'offerName' => $this->input->post('offerName'),
                    'offerDesc' => $this->input->post('offerDesc'),
                    'validUpto' => $this->input->post('validUpto'),
                    'price' => $this->input->post('price'),
                    'discount' => $this->input->post('discount'),
                    'image' => $image_path
                ];

                // Save to database
                if ($this->OfferModel->save_offer($offer_data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Offer added successfully!',
                        'offer' => $offer_data
                    ];
                    echo json_encode($response);
                    return;
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to add offer.'
                    ];
                    echo json_encode($response);
                    return;
                }
            }
        }
    }

    // get offers and pass to the admin view 

    // Fetch all offers
    public function Get_offers() {
        $offers = $this->OfferModel->fetch_all_offers();
        if ($offers) {
            echo json_encode(['status' => 'success', 'data' => $offers]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No offers found.']);
        }
    }


    //delete offer
    public function Delete_offer($id) {
       
        
        if ($this->OfferModel->delete_offer($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Offer deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete offer']);
        }
    }


    // get the offer by id 
    public function Get_offer_by_id($id) {
        $this->load->model('OfferModel');
        
        $offer = $this->OfferModel->get_offer_by_id($id);
        
        if ($offer) {
            echo json_encode([
                'status' => 'success',
                'offer' => $offer
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Offer not found'
            ]);
        }
    }


    //update offers
    public function Update_offer() {
        $offerId = $this->input->post('editId');
        $offerName = $this->input->post('editName');
        $offerDesc = $this->input->post('editDesc');
        $validUpto = $this->input->post('editValidUpto');
        $discount = $this->input->post('editDiscount');
        $price = $this->input->post('editPrice');
        $oldImage = $this->input->post('oldImage');
    
        $newImage = $oldImage; // Default to old image
    
        // Handle the image upload if a new file is provided
        if (isset($_FILES['editImage']) && !empty($_FILES['editImage']['name'])) {
            $config['upload_path'] = './uploads/images/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 10240;  // 10MB max size
            $config['file_name'] = 'offer_' . time();  // Add timestamp to avoid duplicates
    
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('editImage')) {
                $image_data = $this->upload->data();
                $newImage = $image_data['file_name'];
    
                // Delete the old image if it exists and is different from the new one
                if ($oldImage && file_exists('./uploads/images/' . $oldImage)) {
                    unlink('./uploads/images/' . $oldImage);
                }
            } else {
                // Return an error response if the upload fails
                echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                return;
            }
        }
    
        // Update the database
        $updateData = [
            'offerName' => $offerName,
            'offerDesc' => $offerDesc,
            'validUpto' => $validUpto,
            'discount' => $discount,
            'price' => $price,
            'image' => $newImage,
        ];
    
        $this->load->model('OfferModel');
        $updateStatus = $this->OfferModel->update_offer($offerId, $updateData);
    
        echo json_encode(['status' => $updateStatus ? 'success' : 'error', 'message' => $updateStatus ? 'Offer updated successfully' : 'Failed to update offer']);
    }
    
    

    public function ChangePasswordAdmin() {
        $userId = $this->session->userdata('id');
    
        if (!$userId || $this->session->userdata('email') !== 'shubhambhapkar0@gmail.com') {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in or unauthorized']);
            return;
        }
    
        // Decode JSON input
        $input = json_decode(file_get_contents('php://input'), true);
    
        if (!$input) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
            return;
        }
    
        // Set form validation rules
        $this->form_validation->set_data($input);  // Use $input as the data source for validation
        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required');
        $this->form_validation->set_rules('newPassword', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]');
    
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
            return;
        }
    
        $currentPassword = $input['currentPassword'];
        $newPassword = $input['newPassword'];
    
        $userDetails = $this->UserModel->getUserDetails($userId);
    
        if (!$userDetails) {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
            return;
        }
    
        $dbPassword = $userDetails['password'];  // Stored hashed password in the database
    
        // Verify the current password
        if (password_verify($currentPassword, $dbPassword)) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateData = ['password' => $hashedPassword];
    
            if ($this->UserModel->updateUserPassword($userId, $updateData)) {
                echo json_encode(['status' => 'success', 'message' => 'Password updated successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
        }
    }


    public function GetCounts() {
        $this->load->model('OfferModel'); // Load the model
        $data = $this->OfferModel->get_counts(); // Fetch data from the model
        echo json_encode(['status' => 'success', 'data' => $data]); // Send JSON response
    }


    public function GetMenuCounts() {
        $data = $this->MenuModel->get_menu_counts();

        // Return JSON response
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }


        public function GetBookingCounts() {
            // Fetch data from the model
            $data = [
                'pending'            => $this->BookingModel->getBookingCountByStatus('pending'),
                'approved'           => $this->BookingModel->getBookingCountByStatus('approved'),
                'cancelled'          => $this->BookingModel->getBookingCountByStatus('cancel'),
                'completed'          => $this->BookingModel->getBookingCountByStatus('completed'),

                'completed_weekly'   => $this->BookingModel->getBookingCountByStatus('completed', 'weekly'),
                'pending_weekly'   => $this->BookingModel->getBookingCountByStatus('pending', 'weekly'),
                'cancelled_weekly'   => $this->BookingModel->getBookingCountByStatus('cancel', 'weekly'),
                'approved_weekly'   => $this->BookingModel->getBookingCountByStatus('approved', 'weekly'),

                'completed_monthly'  => $this->BookingModel->getBookingCountByStatus('completed', 'monthly'),
                'cancelled_monthly'  => $this->BookingModel->getBookingCountByStatus('cancel', 'monthly'),
                'pending_monthly'   => $this->BookingModel->getBookingCountByStatus('pending', 'monthly'),
                'approved_monthly'   => $this->BookingModel->getBookingCountByStatus('approved', 'monthly'),
            ];

            // Return response in JSON format
            echo json_encode([
                'status' => 'success',
                'data'   => $data
            ]);
        }
    
        public function table() {
            $this->load->view('Admin/Table');
        }
} ?>    