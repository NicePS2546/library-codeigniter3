<?php
class System_time_model extends CI_Model {

    public $table = 'tbn_time_system';
    public $primaryKey = 'time_id';

    public $allowedFields = [
        'start_time_sys',
        'end_time_sys',
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
    public function insertTime($data)
    {
       
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update data in the table
    public function updateTimeSysytem($data, $t_id)
    {
        
        $this->db->where($this->primaryKey, $t_id);
        return $this->db->update($this->table, $data);
    }

    // Get data from the table by ID
    public function getTimeById($t_id)
    {
        $this->db->where($this->primaryKey, $t_id);
        return $this->db->get($this->table)->row_array();
    }
    public function getAllTime()
    {
        return $this->db->get($this->table)->result_array();
    }
}

?>
