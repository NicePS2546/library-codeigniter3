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
        return $query->result_array();
    }
    public function update_admin($id, $data)
{
    return $this->db->where('user_id', $id) // Find the record by ID
                    ->update($this->table, $data); // Update the record with new data
}
    public function get_admin($uid)
    {
       
            return $this->db->where('user_id', $uid)
                            ->where('admin_status', 1) // Add the second condition
                            ->get($this->table)
                            ->row_array();
        
    }

    public function insert_data($data)
    {
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



public function get_monthly_reservations_by_service($year = 2025) {
    // Initialize the array to hold chart data
    $chartData = [
        1 => array_fill(0, 12, 0), // Music service (12 months initialized to 0)
        2 => array_fill(0, 12, 0), // Video service
        3 => array_fill(0, 12, 0)  // Mini service
    ];

    // Query for each service table (assuming service_id corresponds to the table)
    $services = ['tbn_music_reserv' => 1, 'tbn_vdo_reserv' => 2, 'tbn_mini_reserv' => 3];

    foreach ($services as $table => $serviceId) {
        $this->db->select('MONTH(created_at) as month, SUM(total_pp) as total_users');
        $this->db->from($table);
        $this->db->where('YEAR(created_at)', $year);
        $this->db->group_by('MONTH(created_at)');
        $query = $this->db->get();
        $data = $query->result_array();

        // Loop through the data and sum the total_users by month
        foreach ($data as $row) {
            $monthIndex = (int) $row['month'] - 1; // Convert to 0-based index (January = 0)
            $chartData[$serviceId][$monthIndex] += (int) $row['total_users']; // Add total_users for this month
        }
    }

    // Convert associative array to indexed array (for chart rendering)
    return array_values($chartData);
}
}
?>