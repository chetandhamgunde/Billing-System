<?php
defined("BASEPATH") or exit("No direct script access allowed");

class GalleryModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function SaveGalleryImage($imageName)
    {
        $data = [
            'Title' => 'Gallery Image', // You can modify or remove this
            'ImageName' => $imageName
        ];
        $this->db->insert('gallery', $data);
    }


    public function GetGalleryImageById($imageId)
    {
        return $this->db->where('id', $imageId)->get('gallery')->row();
    }

    public function DeleteGalleryImage($imageId)
    {
        $this->db->where('id', $imageId)->delete('gallery');
    }

    
    public function GetAllGalleryImages()
    {
        // Query to select all image paths from the gallery table
        $this->db->select('ImageName'); 
        $this->db->select('id');
        $query = $this->db->get('gallery');

        // Check if query returns any results
        if ($query->num_rows() > 0) {
            return $query->result(); // Return the result as an array of objects
        }
        return [];
    }

    public function getImages() {
        $query = $this->db->get('gallery');
        return $query->result_array(); // Return as array
    }

    public function getFeedbackWithUserDetails() {
        $this->db->select('f.feedback_id, f.comment, f.rating, f.created_at, u.name, u.image');
        $this->db->from('feedback f');
        $this->db->join('users u', 'f.user_id = u.id', 'left');
        $this->db->order_by('f.created_at', 'DESC');  // Order by latest feedback
        return $this->db->get()->result_array();  // Return as an array of feedback with user details
    }
}
