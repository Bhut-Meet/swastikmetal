<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->load->model('Product_model');
        $data['products'] = $this->Product_model->get_latest_products(); // make sure this function exists
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/home', $data);
        $this->load->view('frontend/includes/footer');
    }

    public function load_products() {
        $page = $this->input->get('page');
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $this->db->limit($limit, $offset);
        $query = $this->db->get('products');
        $data['products'] = $query->result();

        $this->load->view('frontend/partials/product_card', $data);
    }

    public function product_details($id) {
        $query = $this->db->get_where('products', ['id' => $id]);
        $data['product'] = $query->row();

        if (!$data['product']) {
            show_404();
        }

        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/product_detail', $data);
        $this->load->view('frontend/includes/footer');
    }
}
