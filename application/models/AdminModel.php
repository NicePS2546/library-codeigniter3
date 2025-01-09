<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    protected $table = 'tbn_admin';
    protected $primaryKey = 'admin_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database connection
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }
    public function get_admin($uid)
    {
        return $this->db->where('user_id', $uid)->get($this->table)->row_array();
    }
    public function insert_data($data)
    {
        $data['created'] = date('T-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update_data($data, $id)
    {
        $data['update_at'] = date('T-m-d H:i:s');
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    // If you want to handle before insert and before update logic
    public function before_insert($data)
    {
        $data['created'] = date('T-m-d H:i:s');
        return $data;
    }

    public function before_update($data)
    {
        $data['update_at'] = date('T-m-d H:i:s');
        return $data;
    }
}




?>