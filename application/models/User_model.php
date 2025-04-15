<?php
class User_model extends CI_Model {

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function update_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
}
