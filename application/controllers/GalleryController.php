<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GalleryController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Load the GalleryModel
        $this->load->model('GalleryModel');
        // Load the upload library
        $this->load->library('upload');
    }

    public function FetchGalleryImages()
    {
        // Fetch gallery images from the model
        $galleryImages = $this->GalleryModel->GetAllGalleryImages();
        // print_r($galleryImages);die;
        // Pass the gallery images to the view
        $data['galleryImages'] = $galleryImages;

        // Load the view with gallery images
        $this->load->view('admin/Gallery', $data); 
    }

    public function UploadGalleryImages()
    {
        $uploadPath = './uploads/gallery/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path']   = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB limit
        $this->upload->initialize($config);

        $uploadedImages = []; // Collect successfully uploaded images
        $errors = []; // Collect error messages

        if (!empty($_FILES['GalleryImages']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['GalleryImages']['name']);

            for ($i = 0; $i < $count; $i++) {
                // Validate file extension
                $fileExtension = pathinfo($files['GalleryImages']['name'][$i], PATHINFO_EXTENSION);
                if (!in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $errors[] = "Invalid file type: " . $files['GalleryImages']['name'][$i];
                    continue; // Skip invalid file
                }

                // Generate a unique filename
                $uniqueFileName = time() . '_' . uniqid() . '.' . $fileExtension;

                $_FILES['File']['name']     = $uniqueFileName;
                $_FILES['File']['type']     = $files['GalleryImages']['type'][$i];
                $_FILES['File']['tmp_name'] = $files['GalleryImages']['tmp_name'][$i];
                $_FILES['File']['error']    = $files['GalleryImages']['error'][$i];
                $_FILES['File']['size']     = $files['GalleryImages']['size'][$i];

                if ($this->upload->do_upload('File')) {
                    // Save each image individually in DB
                    $this->GalleryModel->SaveGalleryImage($uniqueFileName);
                    $uploadedImages[] = $uniqueFileName; // Add to the list of uploaded images
                } else {
                    $errors[] = "Error uploading image: " . $files['GalleryImages']['name'][$i];
                }
            }

            if (!empty($uploadedImages)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Images uploaded successfully.',
                    'uploaded_images' => $uploadedImages
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No valid images uploaded.',
                    'errors' => $errors
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Please select at least one image.'
            ]);
        }
    }

    public function DeleteGalleryImage($imageId)
    {
        // Get image from DB
        $image = $this->GalleryModel->GetGalleryImageById($imageId);

        if ($image) {
            $filePath = './uploads/gallery/' . $image->ImageName;
            // var_dump($filePath);die;

            // Delete file from folder
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Remove entry from the database
            $this->GalleryModel->DeleteGalleryImage($imageId);

            echo json_encode([
                'status' => 'success',
                'message' => 'Image deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Image not found.'
            ]);
        }
    }

    //galllery controller
    
     
    public function GetImages() {
      
        $images = $this->GalleryModel->getImages();
        echo json_encode($images); // Return images as JSON
    }

    public function GetFeedback() {
        $feedbacks = $this->GalleryModel->getFeedbackWithUserDetails();
        if (!empty($feedbacks)) {
            echo json_encode(['status' => 'success', 'data' => $feedbacks]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No feedback found.']);
        }
    }
    
    
}
