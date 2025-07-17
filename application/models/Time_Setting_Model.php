<?php
class Time_Setting_Model extends CI_Model {

    public $table = 'tbn_time_slot_settings';
    public $primaryKey = 't_id';
    public $service_id = 's_id';
    public $allowedFields = [
        's_id',
        'start_time',
        'end_time',
        'interval_hours',
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
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update data in the table
    public function updateTime($data, $id)
    {
        $this->db->where($this->service_id, $id);
        return $this->db->update($this->table, $data);
    }

    // Get data from the table by ID
    public function getTimebyId($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row_array();
    }
    public function getTimeByS_Id($s)
    {
        $this->db->where($this->service_id, $s);
        return $this->db->get($this->table)->row_array();
    }

    // Get all data
    public function getAllTime()
    {
        return $this->db->order_by('s_id', 'ASC')->get($this->table)->result_array();
    }

    public function deletetime($id)
    {
        $this->db->where($this->primaryKey, $id); // Replace 'id' with your table's primary key column
        return $this->db->delete($this->table); // Replace 'rooms' with your table name
    }
}
?>
