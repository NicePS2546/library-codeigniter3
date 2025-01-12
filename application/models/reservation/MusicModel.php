<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
class MusicModel extends CI_Model {
    protected $table = 'tbn_music_reserv';
    protected $primaryKey = 'r_id';
    // Constructor
    public function __construct() {
        parent::__construct();
    }
   
        // Get all reserved time slots for a specific date
        public function get_reserved_slots($r_date,$r_id) {
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
        public function check_availability($startTime, $endTime, $r_date) {
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
        public function reserve($total_pp,$r_number,$st_id,$startTime, $endTime, $r_date) {
            $data = [
                'st_id'      => $st_id, // Replace with actual student ID from session
                'r_number'   => $r_number, // Example reservation number
                'total_pp'   => $total_pp, // Example total people
                'start_time' => $startTime,
                'exp_time'   => $endTime,
                'r_date'     => $r_date,
                'r_status'   => 'actived',
                'r_verify'   => 0, // Assuming no verification yet
            ];
    
            $this->db->insert('tbn_music_reserv', $data);
        }
    }
    
    

