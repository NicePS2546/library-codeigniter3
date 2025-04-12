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
    public function get_reserved($id, $status)
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where('tbn_music_reserv.r_status', $status);
        $this->db->where('tbn_room_music.r_id', $id);
        $query = $this->db->get();
        return $query->result_array(); // Returns the result as an array
    }
    public function get_all_reserved($status='expired')
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where('tbn_music_reserv.r_status', $status);
        $query = $this->db->get();
        return $query->result_array(); // Returns the result as an array
       
    }
    public function get_all_reserved_expired($status='expired')
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where('tbn_music_reserv.r_status', $status);
        $query = $this->db->get();
        return $query->result_array(); // Returns the result as an array
        
    }
    public function get_all_by_reserv_id($st_id, $status = ['expired', 'deleted'])
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where_in('tbn_music_reserv.r_status', $status);
        $this->db->where('tbn_music_reserv.st_id', $st_id);
        $query = $this->db->get();
        return $query->result_array(); // Returns the result as an array
    }
    public function delete_by_id($reserv_id)
    {
        $this->db->where('reserv_id', $reserv_id);

        // Deleting the record
        return $this->db->delete($this->table);


    }
    public function get_reserved_row_view($id, $reserved_id)
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where('tbn_music_reserv.reserv_id', $reserved_id);
        $this->db->where('tbn_room_music.r_id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Returns the result as an array

    }
    public function get_reserved_row($id, $reserved_id)
    {
        $this->db->select('tbn_room_music.r_number, tbn_music_reserv.*');
        $this->db->from('tbn_room_music');
        $this->db->join('tbn_music_reserv', 'tbn_room_music.r_id = tbn_music_reserv.r_id', 'inner'); // Use 'left', 'right', or 'outer' if needed
        $this->db->where('tbn_music_reserv.reserv_id', $reserved_id);

        $query = $this->db->get();
        return $query->row_array(); // Returns the result as an array

    }
    public function get_reserved_sole($id)
    {
        $this->db->where('reserv_id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array(); // Returns the result as an array

    }
    public function check_duplicate($st_id)
    {
        $this->db->select('*');
        $this->db->from('tbn_music_reserv');
        $this->db->where('st_id', $st_id);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function check_time_duplicate($r_id, $start_time, $exp_time) {
        $this->db->where('r_id', $r_id);
        $this->db->where('r_date', date('Y-m-d')); 
        $this->db->where('r_status', 'actived');
        $this->db->where("(
            start_time < '$exp_time' 
            AND exp_time > '$start_time'
        )", NULL, FALSE);
    
        $query = $this->db->get('tbn_music_reserv');
        return $query->num_rows() > 0; // TRUE if overlapping reservation exists
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
        $currentTime = date('H:i');

        $stage = $this->config->item('stage');

        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
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

        return $query->row_array();

    }

    public function update_expire($reservationId)
    {
        $data = [
            'r_status' => 'expired',
        ];
        $this->db->where('reserv_id', $reservationId);  // Use the correct column name
        return $this->db->update('tbn_music_reserv', $data);  // Update the status to expired
    }
    public function update_data($reservationId, $data)
    {
        $this->db->where('reserv_id', $reservationId);
        return $this->db->update($this->table, $data);
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


    protected function get_closest_available_slot($allSlots, $currentTime)
    {
        $closestSlot = null;
        $smallestDiff = PHP_INT_MAX;

        $currentTimestamp = strtotime($currentTime);

        foreach ($allSlots as $slot) {
            list($startTime, $endTime) = explode('-', $slot);
            $slotStartTimestamp = strtotime($startTime);

            // Check if the slot is in the future
            if ($slotStartTimestamp >= $currentTimestamp) {
                $timeDiff = $slotStartTimestamp - $currentTimestamp;

                // Update if this slot is closer than the previously found closest
                if ($timeDiff < $smallestDiff) {
                    $smallestDiff = $timeDiff;
                    $closestSlot = $slot;
                }
            }
        }

        return $closestSlot;
    }


    // protected function get_closest_available_slot($allSlots, $reservedSlots, $currentTime)
    // {
    //     $closestSlot = null;
    //     $smallestDiff = PHP_INT_MAX; // Initialize with a large number

    //     // Loop through all available slots
    //     foreach ($allSlots as $slot) {
    //         list($startTime, $endTime) = explode('-', $slot); // Split the time range

    //         $currentTimestamp = strtotime($currentTime);
    //         $slotStartTimestamp = strtotime($startTime);

    //         // Check if the available slot is in the future
    //         if ($currentTimestamp < $slotStartTimestamp) {
    //             // Check if the end time of any reserved slot matches the start time of this slot
    //             foreach ($reservedSlots as $reserved) {
    //                 $reservedEndTime = date('H:i', strtotime($reserved['exp_time']));
    //                 $reservedEndTimestamp = strtotime($reservedEndTime);

    //                 // Calculate the time difference between reserved slot end and available slot start
    //                 if ($reservedEndTimestamp == $slotStartTimestamp) {
    //                     $timeDiff = abs($reservedEndTimestamp - $currentTimestamp); // Time difference in seconds

    //                     // Update the closest slot if the time difference is smaller
    //                     if ($timeDiff < $smallestDiff) {
    //                         $smallestDiff = $timeDiff;
    //                         $closestSlot = $slot; // Store the closest available slot
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $closestSlot;
    // }




    public function get_closest_time($r_id)
    {
        try {
            $current_date = date('Y-m-d');
            $stage = $this->config->item('stage');
            if ($stage == "Development") {
                $current_time = $this->config->item('fixed_time');
            } else {
                $current_time = date("H:i");
            }
            // Get the reserved slots from the model
            $reservedSlots = $this->get_reserved_slots($current_date, $r_id);


            // Define all possible slots
            // $allSlots = [
            //     '09:00-10:00',
            //     '10:00-11:00',
            //     '11:00-12:00',
            //     '12:00-13:00',
            //     '13:00-14:00',
            //     '14:00-15:00',
            //     '15:00-16:00',
            // ];
            $allSlots = $this->get_all_time(1);



            $validSlots = array_filter($allSlots, function ($slot) use ($current_time) {
                // Extract the end time of the slot
                $parts = explode('-', $slot);
                $start = $parts[0];
                $end = $parts[1];
                return $end > $current_time; // Keep only slots where the end time is in the future
            });

            // Filter out the reserved slots from the valid slots
            $reservedSlotRanges = [];
            foreach ($reservedSlots as $slot) {
                $reservedSlotRanges[] = date('H:i', strtotime($slot['start_time'])) . '-' . date('H:i', strtotime($slot['exp_time']));
            }

            // Find available slots
            $availableSlots = array_diff($validSlots, $reservedSlotRanges);

            // Find Closest time aviliable
            $closest_time = $this->get_closest_available_slot($availableSlots, $current_time);

            return $closest_time;
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in fetch_available_slots: ' . $e->getMessage());
            // Return a JSON response with an error message
            echo $e->getMessage();
        }
    }

    public function batch_update_status($ids, $status)
    {
        if (empty($ids)) {
            return false;
        }
    
        // อัปเดตค่า r_status ในตาราง โดยใช้ WHERE IN()
        $this->db->where_in('reserv_id', $ids)
                 ->set('r_status', $status)
                 ->update($this->table);
    
        return $this->db->affected_rows() > 0;
    }
    public function delete_outdate($reserv_id)
    {
        $this->db->where('reserv_id', $reserv_id);
        $this->db->set('r_status', 'deleted');
    
        return $this->db->update($this->table);
    }

    public function get_statistic_by_day($date)
    { 
        $this->db->select( "SUM(total_pp) AS total_people, COUNT(*) AS total_reservations");
        $this->db->from($this->table);
        $this->db->where("DATE(created_at)", $date); // Extract only the DATE part
        
    
        $query = $this->db->get();
        return $query->result_array(); // Returns an array of results
    }

    public function get_data_by_date_range($start_date, $end_date)
    {
        // Select required columns and sum `total_pp` and count rows for reservations
        $this->db->select('SUM(total_pp) AS total_people, COUNT(*) AS total_reservations');
        $this->db->from($this->table);
        
        // Add a WHERE condition for the date range
        $this->db->where('r_date >=', $start_date); // Filter by start date
        $this->db->where('r_date <=', $end_date);   // Filter by end date
        
        // Run the query
        $query = $this->db->get();
    
        // Return the result
        return $query->row_array(); // Returns a single row of results
    }
    public function statistic_date_range($start_date, $end_date)
    {
        $this->db->select('st_id, COUNT(*) as reservation_count, SUM(total_pp) as total_people');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('r_date >=', $start_date);
        $this->db->where('r_date <=', $end_date);
        $this->db->where('r_status !=', 'deleted'); // optional: exclude deleted
        $this->db->group_by('st_id');
        $this->db->order_by('reservation_count', 'DESC');
        
        $query = $this->db->get();
        return $query->result(); // return as object array
    }
}

