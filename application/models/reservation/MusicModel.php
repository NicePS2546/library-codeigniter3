<?php
class MusicModel extends CI_Model {
    protected $table = 'tbn_music_reserv';
    protected $primaryKey = 'r_id';
    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // Function to reserve a room
    public function reserve_room($st_id, $r_number, $total_pp, $start_date, $visited_ip) {

        // Calculate the expiration time (1 hour after the start time)
        $exp_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 hour'));

        // Check if the room is available during the reservation time range
        if ($this->is_room_available($r_number, $start_date, $exp_date)) {
            // Insert the reservation into the database
            $data = [
                'st_id' => $st_id,
                'r_number' => $r_number,
                'total_pp' => $total_pp,
                'start_date' => $start_date,
                'exp_date' => $exp_date,
                'visited_ip' => $visited_ip,
                'r_status' => 'actived',
                'r_verify' => 0
            ];

            return $this->db->insert('tbn_music_reserv', $data);
        } else {
            // Room is not available during the selected time range
            
            return false;
        }
    }

    // Function to check if the room is available for the given time range
    public function is_room_available($r_number, $start_date, $exp_date) {
        // Check if there is any overlapping reservation in the room
        $this->db->where('r_number', $r_number);
        $this->db->where('start_date <', $exp_date); // Reservation starts before the expiration time
        $this->db->where('exp_date >', $start_date); // Reservation ends after the start time
        $this->db->where('r_status', 'actived'); // Only consider active reservations
        $query = $this->db->get('tbn_music_reserv');

        if ($query->num_rows() > 0) {
            // Adjust start time if it's the same as the end time of another reservation
            foreach ($query->result() as $row) {
                if ($start_date == $row->exp_date) {
                    // Add 5 minutes buffer if the new start time is the same as the previous end time
                    $start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +5 minutes'));
                    $exp_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 hour'));
                    break;
                }
            }
    
            // Recheck availability after adjusting the time
            $this->db->where('r_number', $r_number);
            $this->db->where('start_date <', $exp_date);
            $this->db->where('exp_date >', $start_date);
            $this->db->where('r_status', 'actived');
            $query = $this->db->get('tbn_music_reserv');
    
            // If any overlapping reservation exists after adjustment, room is not available
            if ($query->num_rows() > 0) {
                return false;
            }
        }
    
        return true; // Room is available
    }

    // Function to get all reservations for a room (optional, for monitoring)
    public function get_reservations($r_number) {
        $this->db->where('r_number', $r_number);
        $query = $this->db->get('tbn_music_reserv');
        return $query->result();
    }

    // Function to check if any reservation has expired
    public function check_expired_reservations() {
        $current_time = date('Y-m-d H:i:s');
        $this->db->where('exp_date <', $current_time);
        $this->db->where('r_status', 'actived');
        $this->db->update('tbn_music_reserv', ['r_status' => 'expired']); // Mark expired reservations
    }

    // Function to get the current reservation status (active/expired)
    public function get_reservation_status($reserv_id) {
        $this->db->where('reserv_id', $reserv_id);
        $query = $this->db->get('tbn_music_reserv');
        if ($query->num_rows() > 0) {
            return $query->row()->r_status; // Return reservation status
        }
        return null;
    }

    // Function to verify the reservation (when the reservation is approved or confirmed)
    public function verify_reservation($reserv_id) {
        $this->db->where('reserv_id', $reserv_id);
        $this->db->update('tbn_music_reserv', ['r_verify' => 1]);
    }
}
