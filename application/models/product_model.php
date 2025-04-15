<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Get latest products (limit default = 9)
    public function get_latest_products($limit = 9) {
        return $this->db->order_by('id', 'DESC')
                        ->limit($limit)
                        ->get('products')
                        ->result();
    }

    // Get product by ID
    public function get_product_by_id($product_id)
    {
        return $this->db->get_where('products', ['id' => $product_id])->row();
    }


    public function getProductById($id) {
        return $this->db->get_where('products', ['id' => $id])->row();
    }


    

    // Add new product
    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    // Update product
    public function update_product($id, $data) {
        return $this->db->where('id', $id)
                        ->update('products', $data);
    }

    // Delete product
    public function delete_product($id) {
        return $this->db->where('id', $id)
                        ->delete('products');
    }

    // Get all products for admin
    public function get_all_products() {
        return $this->db->order_by('id', 'DESC')
                        ->get('products')
                        ->result();
    }
}
