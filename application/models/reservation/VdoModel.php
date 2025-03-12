<?php
defined('BASEPATH') or exit('No direct script access allowed');
class VdoModel extends CI_Model
{
    protected $table = 'tbn_vdo_reserv';
    protected $primaryKey = 'r_id';
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    // Get all reserved time slots for a specific date
    public function get_reserved_slots($r_date, $r_id)
    {
        $this->db->select('start_time, exp_time');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('r_date', $r_date);
        $this->db->where('r_id', $r_id);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_reserved($id, $status)
    {
        $this->db->select('tbn_room_vdo.r_number, tbn_vdo_reserv.*');
        $this->db->from('tbn_room_vdo');
        $this->db->join('tbn_vdo_reserv', 'tbn_room_vdo.r_id = tbn_vdo_reserv.r_id', 'inner');
        $this->db->where('tbn_vdo_reserv.r_status', $status);
        $this->db->where('tbn_room_vdo.r_id', $id);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_all_reserved($status)
    {
        $this->db->select('tbn_room_vdo.r_number, tbn_vdo_reserv.*');
        $this->db->from('tbn_room_vdo');
        $this->db->join('tbn_vdo_reserv', 'tbn_room_vdo.r_id = tbn_vdo_reserv.r_id', 'inner');
        $this->db->where('tbn_vdo_reserv.r_status', $status);
        
        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_all_reserved_expired($status='expired')
    {
        $this->db->select('tbn_room_vdo.r_number, tbn_vdo_reserv.*');
        $this->db->from('tbn_room_vdo');
        $this->db->join('tbn_vdo_reserv', 'tbn_room_vdo.r_id = tbn_vdo_reserv.r_id', 'inner');
        $this->db->where('tbn_vdo_reserv.r_status', $status);
        
        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_all_by_reserv_id($st_id,$status = ['expired', 'deleted'])
    {
        $this->db->select('tbn_room_vdo.r_number, tbn_vdo_reserv.*');
        $this->db->from('tbn_room_vdo');
        $this->db->join('tbn_vdo_reserv', 'tbn_room_vdo.r_id = tbn_vdo_reserv.r_id', 'inner');
        $this->db->where_in('tbn_vdo_reserv.r_status', $status);
        $this->db->where('tbn_vdo_reserv.st_id', $st_id);
    
        $query = $this->db->get();

        return $query->result_array();
    }
    public function delete_by_id($reserv_id)
    {
        $this->db->where('reserv_id', $reserv_id);
        // Deleting the record
        return $this->db->delete($this->table); 
        
       
    }
    public function get_reserved_row_view($id,$reserved_id)
    {
        $this->db->select('tbn_room_vdo.r_number, tbn_vdo_reserv.*');
        $this->db->from('tbn_room_vdo');
        $this->db->join('tbn_vdo_reserv', 'tbn_room_vdo.r_id = tbn_vdo_reserv.r_id', 'inner');
        $this->db->where('tbn_vdo_reserv.reserv_id', $reserved_id);
        $this->db->where('tbn_room_vdo.r_id', $id);
        $query = $this->db->get();
        return $query->row_array(); // Returns the result as an array

    }
    public function get_reserved_sole($id){
        $this->db->where('reserv_id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array(); // Returns the result as an array

    }
        public function check_duplicate($st_id)
    {
        $this->db->select('*');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('st_id', $st_id);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function check_availability($startTime, $endTime, $r_date)
    {
        $query = $this->db->where('r_date', $r_date)
            ->where('start_time <', $endTime)
            ->where('exp_time >', $startTime)
            ->where('r_status', 'actived')
            ->get('tbn_vdo_reserv');

        return $query->num_rows() === 0;
    }

    public function reserve($data)
    {
        return $this->db->insert('tbn_vdo_reserv', $data);
    }

    public function get_past_reservations($currentDateTime)
    {
        $currentDate = date('Y-m-d', strtotime($currentDateTime));
        $currentTime = date('H:i');
        $stage = $this->config->item('stage');
        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
        }
        $this->db->select('reserv_id, r_date, exp_time');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('r_status', 'actived');
        $this->db->group_start()
            ->where('r_date <', $currentDate)
            ->or_group_start()
            ->where('r_date', $currentDate)
            ->where('exp_time <', $currentTime)
            ->group_end()
            ->group_end();
        $query = $this->db->get();

        return $query->result_array();
    }
    public function update_expire($reservationId)
    {
        $data = ['r_status' => 'expired'];
        $this->db->where('reserv_id', $reservationId);
        return $this->db->update('tbn_vdo_reserv', $data);
    }

    public function expire_reserv($rows)
    {
        if ($rows) {
            foreach ($rows as $row) {
                $this->update_expire($row['reserv_id']);
            }
        }
    }
    public function get_reserv_in_Time_range($r_id)
    {
        $stage = $this->config->item('stage');
        $currentTime = $stage == "Development" ? $this->config->item('fixed_time') : date('H:i');

        $this->db->select('*');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('r_id', $r_id);
        $this->db->where('start_time <', $currentTime);
        $this->db->where('r_status', 'actived');
        $query = $this->db->get();
        return $query->result_array();
    }

    

    public function get_closest_time($r_id)
    {
        try {
            $current_date = date('Y-m-d');
            $stage = $this->config->item('stage');
            $current_time = $stage == "Development" ? $this->config->item('fixed_time') : date("H:i");

            $reservedSlots = $this->get_reserved_slots($current_date, $r_id);
            // $allSlots = [
            //     '09:00-12:00',
            //     '12:00-15:00',
            //     '15:00-16:00',
            //     ];
            $allSlots = $this->get_all_time(2);

            $validSlots = array_filter($allSlots, function ($slot) use ($current_time) {
                $parts = explode('-', $slot);
                return $parts[1] > $current_time;
            });

            $reservedSlotRanges = array_map(function ($slot) {
                return date('H:i', strtotime($slot['start_time'])) . '-' . date('H:i', strtotime($slot['exp_time']));
            }, $reservedSlots);

            $availableSlots = array_diff($validSlots, $reservedSlotRanges);
            return $this->get_closest_available_slot($availableSlots,  $current_time);
        } catch (Exception $e) {
            log_message('error', 'Error in fetch_available_slots: ' . $e->getMessage());
            return null;
        }
    }

    protected function get_closest_available_slot($allSlots,  $currentTime) {
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
    
        return $closestSlot  ;
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


    // public function get_statistic_by_day($date)
    // {
        
    //     $this->db->select( "SUM(total_pp) AS total_people, COUNT(*) AS total_reservations");
    //     $this->db->from($this->table);
    //     $this->db->where("DATE(created_at)", $date); // Extract only the DATE part
    //     $query = $this->db->get();
    //     return $query->result_array(); // Returns an array of results
    // }

    // public function get_vdo_reservations_by_month($year,$s_id) {
    //     $this->db->select('s_id, MONTH(r_date) AS month, SUM(total_pp) AS total_people, COUNT(*) AS total_reservations, SUM(TIMESTAMPDIFF(HOUR, start_time, exp_time)) AS total_hours');
    // $this->db->from('tbn_vdo_reserv');
    // $this->db->where('YEAR(r_date)', $year); // Filter by year
    // $this->db->where('s_id', $s_id); // Filter by specific service ID
    // $this->db->group_by('s_id, MONTH(r_date)'); // Group by service and month
    // $this->db->order_by('s_id, month'); // Order by service and month
    // $query = $this->db->get();

    // return $query->result_array(); // Return the result as an array
    // }



    public function get_vdo_reservations_by_month($year, $s_id) {
        $this->db->select('MONTH(r_date) AS month, SUM(total_pp) AS total_people, COUNT(*) AS total_reservations, SUM(TIMESTAMPDIFF(HOUR, start_time, exp_time)) AS total_hours');
        $this->db->from('tbn_vdo_reserv');
        $this->db->where('YEAR(r_date)', $year);
        $this->db->where('s_id', $s_id);
        $this->db->group_by('MONTH(r_date)');
        $this->db->order_by('month');
        $query = $this->db->get();
    
        $data = $query->result_array();
    
        // Initialize the chart data with zeros for all 12 months
        $chartData = [
            array_fill(0, 12, 0), // total_pp
            array_fill(0, 12, 0), // total_reservations
            array_fill(0, 12, 0)  // total_hours
        ];
    
        // Loop through the data and populate the corresponding month index
        foreach ($data as $row) {
            $monthIndex = (int) $row['month'] - 1; // Convert to 0-based index
            $chartData[0][$monthIndex] = (int) $row['total_people'];       // total_pp
            $chartData[1][$monthIndex] = (int) $row['total_reservations']; // total_reservations
            $chartData[2][$monthIndex] = (int) $row['total_hours'];        // total_hours
        }
    
        return array_values($chartData);
    }
    
    public function get_statistic_by_day($date)
    { 
        $this->db->select( "SUM(total_pp) AS total_people, COUNT(*) AS total_reservations");
        $this->db->from($this->table);
        $this->db->where("DATE(created_at)", $date); // Extract only the DATE part
        
    
        $query = $this->db->get();
        return $query->result_array(); // Returns an array of results
    }
}
