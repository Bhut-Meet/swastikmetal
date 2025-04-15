<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Ensure only admin has access
        if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != 'admin') {
            redirect('login');
        }

        $this->load->database();
        $this->load->helper(['form', 'url']);
        $this->load->library(['upload', 'session']);
    }

    // Show all products
    public function index() {
        $data['products'] = $this->db->order_by('id', 'DESC')->get('products')->result();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/products', $data);
        $this->load->view('admin/includes/footer');
    }

    // Show product addition form
    public function add() {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/add_product');
        $this->load->view('admin/includes/footer');
    }

// Insert a new product
public function insert() {
    // Load necessary helpers and libraries
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('upload');
    
    // Form validation rules
    $this->form_validation->set_rules('name', 'Product Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');
    $this->form_validation->set_rules('discount_price', 'Discount Price', 'required');
    $this->form_validation->set_rules('size', 'Size', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        // Load the form if validation fails
        $this->load->view('admin/add_product');
    } else {
        // Handle image upload for main image
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB max
        $this->upload->initialize($config);
    
        // Check if the image upload is successful
        if (!$this->upload->do_upload('main_image')) {
            // If upload fails, display error messages
            echo $this->upload->display_errors();  // Display upload errors if any
        } else {
            // If upload succeeds, get file data and store file name
            $main_image_data = $this->upload->data();
            $main_image = $main_image_data['file_name'];
        }
    
        // Handle additional images upload (if any)
        $additional_images = [];
        if (!empty($_FILES['additional_images']['name'][0])) {
            $files_count = count($_FILES['additional_images']['name']);
            for ($i = 0; $i < $files_count; $i++) {
                $_FILES['file']['name'] = $_FILES['additional_images']['name'][$i];
                $_FILES['file']['type'] = $_FILES['additional_images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['additional_images']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['additional_images']['error'][$i];
                $_FILES['file']['size'] = $_FILES['additional_images']['size'][$i];
                
                if ($this->upload->do_upload('file')) {
                    $file_data = $this->upload->data();
                    $additional_images[] = $file_data['file_name'];
                }
            }
        }
    
        // Prepare data to insert into the database
        $product_data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'discount_price' => $this->input->post('discount_price'),
            'size' => $this->input->post('size'),
            'main_image' => $main_image,
            'additional_images' => json_encode($additional_images),
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        // Insert product data into the database
        $this->db->insert('products', $product_data);
    
        // Redirect after insertion
        redirect('admin/product');
    }
}



    // Edit product
    public function edit($id) {
        $data['product'] = $this->db->where('id', $id)->get('products')->row();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/edit_product', $data);
        $this->load->view('admin/includes/footer');
    }

    // Update product
    public function update($id) {
        // Upload settings
        $config['upload_path']   = './uploads/products/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $this->upload->initialize($config);

        // Main Image Upload
        $main_image = '';
        if (!empty($_FILES['main_image']['name'])) {
            if ($this->upload->do_upload('main_image')) {
                $upload_data = $this->upload->data();
                $main_image = $upload_data['file_name'];
            }
        }

        // Additional Images Upload
        $additional_images = [];
        if (!empty($_FILES['additional_images']['name'][0])) {
            $files = $_FILES;
            $count = count($_FILES['additional_images']['name']);

            for ($i = 0; $i < $count; $i++) {
                $_FILES['file']['name']     = $files['additional_images']['name'][$i];
                $_FILES['file']['type']     = $files['additional_images']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['additional_images']['tmp_name'][$i];
                $_FILES['file']['error']    = $files['additional_images']['error'][$i];
                $_FILES['file']['size']     = $files['additional_images']['size'][$i];

                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $img_data = $this->upload->data();
                    $additional_images[] = $img_data['file_name'];
                }
            }
        }

        // Update data
        $data = [
            'name'             => $this->input->post('name'),
            'description'      => $this->input->post('description'),
            'price'            => $this->input->post('price'),
            'discount_price'   => $this->input->post('discount_price'),
            'size'             => $this->input->post('size'),
            'main_image'       => $main_image,
            'additional_images'=> json_encode($additional_images),
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id)->update('products', $data);
        $this->session->set_flashdata('success', 'Product updated successfully!');
        redirect('admin/product');
    }

    // Delete product
    public function delete($id) {
        $this->db->where('id', $id)->delete('products');
        $this->session->set_flashdata('success', 'Product deleted!');
        redirect('admin/product');
    }
}
?>
