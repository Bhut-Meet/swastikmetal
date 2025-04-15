<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('Product_model');
    }

    public function add() {
        $product_id = $this->input->post('product_id');
        $size = $this->input->post('size');
        $qty = $this->input->post('qty');

        // Optional: check if product exists
        $product = $this->Product_model->getProductById($product_id);
        if (!$product) {
            echo json_encode(['status' => 'error', 'message' => 'Product not found']);
            return;
        }

        $data = [
            'product_id' => $product_id,
            'user_id' => 1, // for now using default user ID
            'quantity' => $qty,
            'size' => $size
        ];

        $insert = $this->Cart_model->addToCart($data);

        if ($insert) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert into cart']);
        }
    }


    public function remove($cart_id) {
        $this->load->model('Cart_model');
    
        // Call the model method to remove the cart item
        $remove = $this->Cart_model->removeFromCart($cart_id);
    
        if ($remove) {
            // Redirect back to the cart page after removal
            redirect('cart');
        } else {
            echo "Error: Failed to remove item from cart.";
        }
    }
    

    public function update_quantity() {
        $cartId = $this->input->post('cart_id');
        $quantity = $this->input->post('quantity');
        
        // Update the quantity in the cart
        $this->Cart_model->updateQuantity($cartId, $quantity);
        
        // Get the updated item price
        $cart_item = $this->Cart_model->getCartItemsWithProductDetails(1); // Assuming user ID is 1
        $item = array_filter($cart_item, function($item) use ($cartId) {
            return $item['id'] == $cartId;
        });
        
        // Get item price and send success response
        $item = array_values($item)[0]; // Get the first matching item
        $response = [
            'success' => true,
            'item_price' => $item['product_price'] // Send price for recalculating the item total
        ];
        
        echo json_encode($response);
    }
    
    
    
    
    public function view() {
        $this->load->model('cart_model');
        
        // Fetch cart items
        $cart_items = $this->cart_model->get_cart_items();
        
        // Calculate total
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['product_price'] * $item['quantity'];  // Add each item's total to the overall total
        }
        
        // Prepare data to pass to the view
        $data['cart_items'] = $cart_items;
        $data['total'] = $total;  // Pass the total to the view
        
        // Load the view
        $this->load->view('cart_view', $data);  // Pass $data array to the view
    }
    
    
    
    
    

    public function index() {
        // Fetch cart items along with product details
        $data['cart_items'] = $this->Cart_model->getCartItemsWithProductDetails(1); // default user_id
        $this->load->view('cart_view', $data);
    }
    
    
}
