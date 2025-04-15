<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function login() {
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/login');
        $this->load->view('frontend/includes/footer');
    }

    public function login_submit() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user_by_email($email);

        if ($user && $user->password == $password) { // For now, plain text check
            // $user->password == password_verify($password, $user->password)

            $this->session->set_userdata([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role
            ]);

            // ✅ Correct redirection based on role
            if ($user->role == 'admin') {
                redirect('admin/dashboard'); // Make sure this controller exists
            } else {
                redirect('home'); // Or wherever your user dashboard is
            }

        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('auth/login');
        }
    }

    public function register() {
        if ($_POST) {
            $data = [
                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'password' => $this->input->post('password'), // Plain text for now
                // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'mobile'   => $this->input->post('mobile'),
                'role'     => 'user' // default
            ];

            $this->User_model->insert_user($data);
            $this->session->set_flashdata('success', 'Registered successfully');
            redirect('auth/login');
        } else {
            $this->load->view('frontend/includes/header');
            $this->load->view('frontend/register');
            $this->load->view('frontend/includes/footer');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}
