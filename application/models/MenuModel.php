<?php
defined("BASEPATH") or exit("No direct script access allowed");

class MenuModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function Add_Menu($formdata)
    {
        $data = array(
            'name' => $formdata['name'],
            'description' => $formdata['description'],
            'price' => $formdata['price'],
            'image' => isset($formdata['image']) ? $formdata['image'] : null,
            'category_id' => $formdata['category_id']
        );

        return $this->db->insert('menus', $data);
    }

    public function getAllMenus()
    {
        $this->db->where('deleted_at IS NULL', null, false);
        $query = $this->db->get('menus');
        return $query->result_array();
    }



    // Get menu item by ID
    public function getMenuById($id)
    {
        return $this->db->get_where('menus', ['id' => $id])->row_array();
    }

    // Update menu item
    public function updateMenu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('menus', $data);
    }

    // Delete menu item
    public function deleteMenu($id)
    {
        // Get the existing menu item
        $menu = $this->getMenuById($id);

        if ($menu) {
            // Delete image from folder (Optional: Only if you want to remove images on delete)
            $imagePath = './assets/images/menu/' . $menu['image'];
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            // Soft delete: update `deleted_at` instead of removing row
            $this->db->where('id', $id);
            return $this->db->update('menus', ['deleted_at' => date('Y-m-d H:i:s')]);
        }

        return false;
    }


    public function categoryExists($categoryName)
    {
        $this->db->where('name', $categoryName);
        $query = $this->db->get('categories');
        return $query->num_rows() > 0;
    }

    public function addCategory($categoryName)
    {
        $data = [
            'name' => $categoryName,

        ];
        return $this->db->insert('categories', $data);
    }

    public function EditCategory($id, $categoryName)
    {
        // Set the new category name for the specified ID
        $this->db->where('id', $id);
        return $this->db->update('categories', ['name' => $categoryName]);
    }


    public function deleteCategory($id)
    {
        // Soft delete related menu items
        $this->db->set('deleted_at', 'NOW()', false);
        $this->db->where('category_id', $id);
        $this->db->update('menus');

        // Hard delete the category
        $this->db->where('id', $id);
        $this->db->delete('categories');

        return ($this->db->affected_rows() > 0);
    }


    public function Get_menu_counts()
    {

        // 1. Get the total number of menus
        $total_menus = $this->db->count_all("menus");

        // 2. Get count of menus grouped by category_id, including first 4 categories
        $query = $this->db->query("
            SELECT categories.id AS category_id, categories.name AS category_name, 
                   COUNT(menus.id) AS menu_count 
            FROM categories 
            LEFT JOIN menus ON categories.id = menus.category_id 
            GROUP BY categories.id
        ");

        $category_counts = [];
        foreach ($query->result() as $row) {
            $category_counts[] = [
                'category_id' => $row->category_id,
                'category_name' => $row->category_name,
                'menu_count' => $row->menu_count
            ];
        }

        return [
            'total_menus' => $total_menus,
            'category_counts' => $category_counts
        ];
    }
}
