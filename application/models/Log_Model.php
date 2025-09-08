<?php
class Log_Model extends CI_Model
{

    public $table = 'tbn_reservation_log_present';
    public $primaryKey = 'id';

    public $allowedFields = [
        'reserv_id',
        'r_service',
        'action_type',
        'reason',
        'perform_by',
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
        return $this->db->insert($this->table, $data);

    }


    // Update data in the table
    public function update($data, $id)
    {

        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    // Get data from the table by ID


    public function getRowById($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->get($this->table)->row_array();
    }

    // Get all data
  public function getAllrow()
{
    $this->db->order_by('created_at', 'DESC'); // or 'ASC' for oldest first
    return $this->db->get($this->table)->result_array();
}
    public function getCountRow($action_type)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->from($this->table);
        $this->db->where('action_type', $action_type);
        $query = $this->db->get();
        return $query->row()->count; // return just the integer
    }



    public function deleteLog($id)
    {
        $this->db->where('id', $id); // Replace 'id' with your table's primary key column
        return $this->db->delete($this->table); // Replace 'rooms' with your table name
    }
}
?>