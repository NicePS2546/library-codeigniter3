<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatisticModel extends CI_Model
{
    protected $table = 'tbn_statistic';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database connection
    }

    /**
     * Update daily statistics for a specific service
     *
     * @param int $service_id - The service ID
     * @param int $new_users - Number of new users to add
     * @param int $new_reservations - Number of new reservations to add
     */
    public function updateDailyStatistics($service_id, $new_users = 0, $new_reservations = 0)
    {
        $today = date('Y-m-d');

        // Check if today's record exists for the given service
        $this->db->where('stat_date', $today);
        $this->db->where('service_id', $service_id);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            // Update the existing record
            $this->db->set('total_users', 'total_users + ' . (int) $new_users, FALSE);
            $this->db->set('total_reservations', 'total_reservations + ' . (int) $new_reservations, FALSE);
            $this->db->where('stat_date', $today);
            $this->db->where('service_id', $service_id);
            return $this->db->update($this->table);
        } else {
            // Insert a new record for today
            $data = [
                'stat_date' => $today,
                'service_id' => $service_id,
                'total_users' => $new_users,
                'total_reservations' => $new_reservations
            ];
            return $this->db->insert($this->table, $data);
        }
    }
  

    public function get_by_service($service){
        $today = date('Y-m-d');
        $this->db->where('service_id',$service);
        $this->db->where('stat_date', $today);

        return $this->db->get($this->table)->row_array();
    }
}