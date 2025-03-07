<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfferModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }

    // Function to save offer details
    public function save_offer($offer_data) {
        return $this->db->insert('offers', $offer_data);
    }

    // get offers all 
    public function fetch_all_offers() {
        $this->db->select('*');
        $this->db->from('offers'); // Ensure this matches your table name
        $query = $this->db->get();
        return $query->result_array(); // Return all offers as an array
    }

    public function delete_offer($id) {
        // Check if the offer exists
        $this->db->where('id', $id);
        $offer = $this->db->get('offers')->row();
        
        if ($offer) {
            // Delete the offer image file if it exists
            $imagePath = FCPATH . 'uploads/images/' . $offer->image;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
            // Delete the offer from the database
            $this->db->where('id', $id);
            return $this->db->delete('offers');
        } else {
            return false; // Offer not found
        }
    }

    public function get_offer_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('offers'); // Assuming 'offers' is your table name

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the offer data as an array
        }
        return null; // Return null if the offer is not found
    }


    //offer model
    public function update_offer($offerId, $data) {
        // Update the offer in the database
        $this->db->where('id', $offerId);
        return $this->db->update('offers', $data); // Assuming the table is named 'offers'
    }


    public function get_counts() {
      
        // Count users
        $users_count = $this->db->count_all("users") - 1;

        // Count feedbacks
        $feedback_count = $this->db->count_all("feedback");

        // Count bookings
        $bookings_count = $this->db->count_all("bookings");

        return [
            'users' => $users_count,
            'feedbacks' => $feedback_count,
            'bookings' => $bookings_count
        ];
    }
}
