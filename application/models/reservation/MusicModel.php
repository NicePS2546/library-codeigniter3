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
    public function check_duplicate($st_id, $r_id)
    {
        $this->db->select('*');
        $this->db->from('tbn_music_reserv');
        $this->db->where('r_id', $r_id);
        $this->db->where('st_id', $st_id);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

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
        // Set the timezone to Bangkok, Thailand


        // Extract the current date from the datetime
        $currentDate = date('Y-m-d', strtotime($currentDateTime));

        // Hardcoded current time for testing
        $currentTime = null;

        $stage = $this->config->item('stage');

        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
        } else {
            $currentTime = date('H:i', strtotime($currentDateTime));
        }



        // Query to select expired reservations
        $this->db->select('reserv_id, r_date, exp_time');
        $this->db->from('tbn_music_reserv');
        $this->db->where('r_status', 'actived');
        $this->db->group_start()
            ->where('r_date <', $currentDate) // If the reservation date is in the past
            ->or_group_start()
            ->where('r_date', $currentDate) // If the reservation is for today
            ->where('exp_time <', $currentTime) // And the expiration time has passed
            ->group_end()
            ->group_end();
        $query = $this->db->get();

        return $query->result_array(); // Return the list of past reservations
    }

    // public function get_past_reservations($currentDateTime)
    // {
    //     // Extract the date from the current datetime
    //     $currentDate = date('Y-m-d', strtotime($currentDateTime));
    //     $currentTime = date('H:i');
    //     $currentTime = "11:01";
    //     $this->db->select('reserv_id, r_date');
    //     $this->db->from('tbn_music_reserv');
    //     $this->db->where('r_status', 'actived');
    //     $this->db->where('r_date <', $currentDate); // Compare with current date only

    //     $query = $this->db->get();

    //     return $query->result_array(); // Return the list of past reservations
    // }

    public function get_reserv_in_Time_range($r_id)
    {

        $stage = $this->config->item('stage');

        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
        } else {
            $currentTime = date('H:i');
        }


        $this->db->select('*');
        $this->db->from('tbn_music_reserv');
        $this->db->where('r_id', $r_id);
        $this->db->where('start_time <=', $currentTime);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

        return $query->result_array();

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




    public function get_closest_available_slot($reservedSlots, $currentTime)
    {
        $closestSlot = null;
        $smallestDiff = PHP_INT_MAX; // Initialize with a large numbe

        $allSlots = [
            '09:00-10:00',
            '10:00-11:00',
            '11:00-12:00',
            '12:00-13:00',
            '13:00-14:00',
            '14:00-15:00',
            '15:00-16:00',
            // Add more slots as needed
        ];

        // Loop through all available slots
        foreach ($allSlots as $slot) {
            list($startTime, $endTime) = explode('-', $slot); // Split the time range

            $currentTimestamp = strtotime($currentTime);
            $slotStartTimestamp = strtotime($startTime);

            // Check if the available slot is in the future
            if ($currentTimestamp < $slotStartTimestamp) {
                // Check if the end time of any reserved slot matches the start time of this slot
                foreach ($reservedSlots as $reserved) {
                    $reservedEndTime = date('H:i', strtotime($reserved['exp_time']));
                    $reservedEndTimestamp = strtotime($reservedEndTime);

                    // Calculate the time difference between reserved slot end and available slot start
                    if ($reservedEndTimestamp == $slotStartTimestamp) {
                        $timeDiff = abs($reservedEndTimestamp - $currentTimestamp); // Time difference in seconds

                        // Update the closest slot if the time difference is smaller
                        if ($timeDiff < $smallestDiff) {
                            $smallestDiff = $timeDiff;
                            $closestSlot = $slot; // Store the closest available slot
                        }
                    }
                }
            }
        }


        return $closestSlot;
    }
}



