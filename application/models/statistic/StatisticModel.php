<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
    public function update_on_cancel($service_id, $canceled_users = 0, $canceled_reservations = 1)
    {

        return $this->updateDailyStatistics($service_id, -$canceled_users, -$canceled_reservations);
    }
    public function get_statistic_data()
    {
        $query = $this->db->select('stat_date, service_id, total_users, total_reservations')
            ->from('tbn_statistic')
            ->order_by('stat_date')
            ->get();
        return $query->result_array();
    }
    public function get_statistic_data_current_year() {
        $current_year = date('Y'); // Get current year

        $query = $this->db->select('stat_date, service_id, total_users, total_reservations')
                          ->from('tbn_statistic')
                          ->where('YEAR(stat_date)', $current_year) // Filter by current year
                          ->order_by('stat_date')
                          ->get();

        return $query->result_array();
    }

    public function get_by_service($service)
    {
        $today = date('Y-m-d');
        $this->db->where('service_id', $service);
        $this->db->where('stat_date', $today);

        return $this->db->get($this->table)->row_array();
    }
    public function get_by_d_s($service,$date)
    {
        $today = date('Y-m-d');
        $this->db->where('service_id', $service);
        $this->db->where('stat_date', $date);

        return $this->db->get($this->table)->row_array();
    }
   public function get_year_satatistic($year = 2025){
    $this->db->select('*');
    $this->db->from('tbn_statistic');
    $this->db->where('YEAR(stat_date)', $year); // Filter by year
    $query = $this->db->get();

    // Check if any rows are returned
    return $query->result_array();
   }
   public function get_month_satatistic($year = 2025){
    $this->db->select('MONTH(stat_date) as month, service_id, SUM(total_users) as total_users');
    $this->db->from('tbn_statistic');
    $this->db->where('YEAR(stat_date)', $year); // Filter by year
    $this->db->group_by(['MONTH(stat_date)', 'service_id']);
    $query = $this->db->get();
    return $query->result_array();
   }

   public function get_total_by_date_range($start_date, $end_date) {
      // Prepare the SQL query to sum up total_users and total_reservations for each service_id within the date range
      $this->db->select('service_id, SUM(total_users) AS total_users, SUM(total_reservations) AS total_reservations');
      $this->db->from('tbn_statistic');
      $this->db->where('stat_date >=', $start_date);
      $this->db->where('stat_date <=', $end_date);
      $this->db->group_by('service_id');  // Group the results by service_id
      $query = $this->db->get();
  
      // Return the results as an array
      return $query->result_array();
}
}