<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    // Show product details for customers
    public function details($id) {
        $data['product'] = $this->db->get_where('products', ['id' => $id])->row();

        if (!$data['product']) {
            show_404();
        }

        $this->load->view('frontend/includes/header');  // Your public header file
        $this->load->view('frontend/product_details', $data);
        $this->load->view('frontend/includes/footer');  // Your public footer file
    }
}
