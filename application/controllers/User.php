<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        $this->load->model('OfferModel');
        $this->load->model('MenuModel');
        $this->load->model('CategoriesModel');
	}
    
    public function Home(){
        // Fetch all categories
        $data['categories'] = $this->CategoriesModel->getCategories();

        // Fetch all menus
        $data['menus'] = $this->MenuModel->getAllMenus();
        
        $this->load->view('User/Home',$data);
    }

    public function Menu()
    {
        // Fetch all categories
        $data['categories'] = $this->CategoriesModel->getCategories();

    
        // Fetch all menus
        $data['menus'] = $this->MenuModel->getAllMenus();

        $this->load->view('User/Menu',$data);
    }

    public function TableBooking()
    {
        $this->load->view('User/TableBooking');
    }
	

    /// get the offer for the use 
    public function Get_offers() {
        $offers = $this->OfferModel->fetch_all_offers();
        if ($offers) {
            echo json_encode(['status' => 'success', 'data' => $offers]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No offers found.']);
        }
    }

	

	
	
} ?>
