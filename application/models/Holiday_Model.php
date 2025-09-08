<?php
class Holiday_Model extends CI_Model
{

    public $table = 'tbn_holiday_present';
    public $primaryKey = 'r_id';

    public $allowedFields = [
        'holiday_id',
        'date',
        'color',
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
    public function insertHoliday($data)
    {
        return $this->db->insert($this->table, $data);

    }

    public function batchInsertOrUpdateHolidays($data)
    {
        $values = [];
        foreach ($data as $row) {
            $values[] = "('{$row['date']}', '{$row['title']}')";
        }

        $valuesStr = implode(',', $values);

        $sql = "INSERT INTO {$this->table} (date, title)
            VALUES {$valuesStr}
            ON DUPLICATE KEY UPDATE title = VALUES(title)";

        return $this->db->query($sql);
    }


    // Update data in the table
    public function updateRoom($data, $id)
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
    public function getAllDate()
    {
        return $this->db->order_by('date', 'ASC')->get($this->table)->result_array();
    }
    public function getDate($date){
        $this->db->where('date',$date);
        return $this->db->get($this->table)->row_array();
    }

    public function deleteHoliday($date)
    {
        $this->db->where('date', $date); // Replace 'id' with your table's primary key column
        return $this->db->delete($this->table); // Replace 'rooms' with your table name
    }

    public function batch_delete_old_date()
{
    $current_date = date('Y-m-d');
    
    $this->db->where('date <', $current_date);
    $this->db->delete($this->table);

    return $this->db->affected_rows() > 0;
}

}
?>