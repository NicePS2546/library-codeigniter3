<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vdo_service_Model extends CI_Model
{
    // Table name
    private $table = 'tbn_vdo_services';

    public function __construct()
    {
        parent::__construct();
    }


    public function get_all()
    {
        return $this->db->get($this->table)->result_array();
    }

    
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['service_id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

   
    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['service_id' => $id]);
    }

    
    public function delete($id)
    {
        return $this->db->delete($this->table, ['service_id' => $id]);
    }
}
