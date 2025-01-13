<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MusicModel extends CI_Model
{
    protected $table = 'tbn_music_reserv';
    protected $primaryKey = 'r_id';
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // Get all reserved time slots for a specific date
    public function get_reserved_slots($r_date, $r_id)
    {
        // Query to fetch reserved start_time and exp_time for the given date
        $this->db->select('start_time, exp_time');
        $this->db->from('tbn_music_reserv');
        $this->db->where('r_date', $r_date);
        $this->db->where('r_id', $r_id);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

        // Return the reserved slots as an array
        return $query->result_array();
    }

    // Check if the selected time range is available for a specific date
    public function check_availability($startTime, $endTime, $r_date)
    {
        // Query to check if there's a conflict with the selected time slot
        $query = $this->db->where('r_date', $r_date)
            ->where('start_time <', $endTime)
            ->where('exp_time >', $startTime)
            ->where('r_status', 'actived') // Only active reservations
            ->get('tbn_music_reserv');

        if ($query->num_rows() > 0) {
            return false; // Conflict found
        }

        return true; // No conflict
    }

    // Make a reservation
    public function reserve($data)
    {

        return $this->db->insert('tbn_music_reserv', $data);
    }

    public function get_past_reservations($currentDateTime)
    {
        // Extract the date from the current datetime
        $currentDate = date('Y-m-d', strtotime($currentDateTime));

        $this->db->select('reserv_id, r_date');
        $this->db->from('tbn_music_reserv');
        $this->db->where('r_status', 'actived');
        $this->db->where('r_date <', $currentDate); // Compare with current date only
        $query = $this->db->get();

        return $query->result_array(); // Return the list of past reservations
    }


    public function update_expire($reservationId)
{
    $data = [
        'r_status' => 'expired',
    ];
    $this->db->where('reserv_id', $reservationId);  // Use the correct column name
    $this->db->update('tbn_music_reserv', $data);  // Update the status to expired
}

    public function expire_reserv($rows)
    {
        if ($rows) {
            // Loop through the past reservations and update them to expired
            foreach ($rows as $row) {
                $this->update_expire($row['reserv_id']);  // Expire the reservation by ID
            }
        }
    }
}



