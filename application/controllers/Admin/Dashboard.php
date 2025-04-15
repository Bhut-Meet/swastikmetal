<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // ✅ Only admin can access this page
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != 'admin') {
            redirect('login');
        }

        $this->load->library('session');
    }

    public function index() {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/dashboard');  // <-- Create this view file
        $this->load->view('admin/includes/footer');
    }
}
