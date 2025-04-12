<?php
class RoomVdo extends CI_Model {

    public $table = 'tbn_room_vdo';
    public $primaryKey = 'r_id';

    public $allowedFields = [
        'r_number',
        'r_status',
        'r_desc',
    ];

    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Insert hook method for created timestamp
    public function createdStamp($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    // Update hook method for modified timestamp
    public function modifiedStamp($data)
    {
        $data['update_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    // Insert data into the table
    public function insertRoom($data)
    {
       
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update data in the table
    public function updateRoom($data, $id)
    {
        
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    // Get data from the table by ID
    public function getRoomById($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row_array();
    }
    public function getRoomByNumber($n)
    {
        $this->db->where('r_number', $n);
        return $this->db->get($this->table)->row();
    }


    // Get all data
    public function getAllRoom()
    {
        return $this->db->order_by('r_number', 'ASC')->get($this->table)->result_array();
    }

    public function deleteRoom($id)
    {
        $this->db->where($this->primaryKey, $id); // Replace 'id' with your table's primary key column
        return $this->db->delete($this->table); // Replace 'rooms' with your table name
    }
    public function getRowById($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row_array();
    }
}
?>
