<?php
class Cart_model extends CI_Model {

    public function addToCart($data) {
        return $this->db->insert('cart', $data);
    }

    public function getCartItemsWithProductDetails($user_id) {
        // Join cart table with product table to get product details
        $this->db->select('cart.*,cart.user_id, products.name as product_name, products.price as product_price');
        $this->db->from('cart');
        $this->db->join('products', 'products.id = cart.product_id');
        $this->db->where('cart.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function removeFromCart($cart_id) {
        // Delete the cart item by cart_id
        $this->db->where('id', $cart_id);
        return $this->db->delete('cart');
    }


    public function updateQuantity($cart_id, $quantity) {
        $data = ['quantity' => $quantity];
    
        // Update the quantity in the cart table
        $this->db->where('id', $cart_id);
        return $this->db->update('cart', $data);
    }
    
    
    
}
