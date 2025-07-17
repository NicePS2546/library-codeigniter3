<?php
class OnlineUser_model extends CI_Model {
    
    public $table = "tbn_online_users";
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get the number of current online users
    public function get_online_users() {
        $query = $this->db->get_where($this->table, ['id' => 1]);
        return $query->row_array();
    }

    // Add an online user
    public function add_online_user() {
        $this->db->set('user_count', 'user_count + 1', FALSE);
        $this->db->where('id', 1);
        $this->db->update($this->table);
    }

    // Remove an online user
    public function remove_online_user() {
        $this->db->set('user_count', 'GREATEST(user_count - 1, 0)', FALSE);
        $this->db->where('id', 1);
        $this->db->update($this->table);
    }
}
