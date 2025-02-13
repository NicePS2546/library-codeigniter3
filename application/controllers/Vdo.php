<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vdo extends CI_Controller
{
    public function index()
    {
        $this->load->model('RoomVdo');
        $model = $this->RoomVdo;
        $data = $model->getAllRoom();

        $this->load->model('reservation/VdoModel');
        $r_model = $this->VdoModel;

       

        return $this->Render("vdo", [
            'title' => 'Video On-Demand',
            'rooms' => $data,
            'page' => 'vdo',
            'model'=> $r_model,
           
        ]);

    }
    public function service_page($r_id){
        $this->load->model('Vdo_service_Model');
        $model = $this->Vdo_service_Model;
        $services = $model->get_all();

        return $this->Render('reservation/vdo/vdo_service',[
            'title'=>'VDO Service',
            'r_id' =>$r_id,
            'services'=>$services,
            'page'=>'vdo'
        ]);
    }
    public function reserv_page($r_id,$s_id){
        return $this->Render('reservation/vdo/vdo_reserv',[
            'title'=>"Reservation",
            'page'=>"vdo",
            'r_id' => $r_id,
            's_id' => $s_id    
        ]);
    }

    public function reserv() {
        $this->load->model('reservation/VdoModel');
        $model = $this->VdoModel;

        $this->load->model('reservation/MusicModel');
        $musicModel = $this->MusicModel;
        
        $this->load->model('statistic/StatisticModel');
        $statistic = $this->StatisticModel;

        $extension = "index.php/";
        $r_id = $this->input->post('r_id');  // Room number
        $st_id = $this->input->post('st_id');        // Student ID
        $s_id = $this->input->post('s_id');        // Student ID
        $total_pp = $this->input->post('total');     // Total people
        
        $time_slot = $this->input->post('time_slot'); // Selected time slot
        $currentDate = date('Y-m-d');  // Get the current date
       
        $stage = $this->config->item('stage');
		if($stage == "Development"){
			$currentTime = $this->config->item('fixed_time');
		}else{
            $currentTime = date('H:i');  // Get the current time
		}
       
        
    // Convert the selected time range (e.g., '09:00-10:00') to start_time and exp_time
        list($start_time, $exp_time) = explode('-', $time_slot);
        $vdo_dupl = $model->check_duplicate($st_id,$r_id);
        $music_dulp = $musicModel->check_duplicate($st_id,$r_id);
        $data = [
            'st_id' => $st_id,  // Example: Replace with actual student/user ID
            'r_id' => $r_id, // Room number
            'total_pp' => $total_pp,  // Total people
            's_id'=>$s_id,
            'start_time' => $start_time,
            'exp_time' => $exp_time,
            'r_date' => $currentDate,
            'r_status' => 'actived', // Status of the reservation
            'r_verify' => 0,  // Verification flag (0 for unverified)
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        ];
        $sweet = '';
        $day = getDay(date("Y-m-d H:i"));
        if($day === "Saturday"){
            $sweet =  '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการหยุดวันเสาร์",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'vdo"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }
        if($currentTime > "16:00"){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'vdo"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }else if($currentTime < "08:00"){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ",
                    showConfirmButton: true,
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }
        

        // Check if the room number and other inputs are valid
        
        if (!$r_id || !$st_id || !$total_pp || !$time_slot) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo/reserv/' . $r_id . '/'.$s_id.'"; 
                });
            }, 1000);
            </script>';
           return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }else if($total_pp < 1){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนคนน้อยกว่าที่กำหนด",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo/reserv/' . $r_id . '/'.$s_id.'"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }else if($total_pp > 6){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนคนมากกว่าที่กำหนด",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo/reserv/' . $r_id . '/'.$s_id.'"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }
        
        if($music_dulp || $vdo_dupl){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนการจองเกินกำหนด 1 ผู้ใช้ ต่อ 1 การจอง",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet,'Video Reservation','vdo');  // Stop execution if validation fails
        }
       
        $result = transaction($this->db,$model->reserve($data),$statistic->updateDailyStatistics(2, $total_pp, 1));

        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "จองห้องสำเร็จ!",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo/check/'.$r_id.'"; 
                });
            }, 1000);
            </script>';
        } else {
            $sweet =  '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จองห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'vdo/reserv/' . $r_id . '/'.$s_id.'"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet,'Video Reservation','vdo');
            
    }

    public function get_availible_slots($r_id) {
        try {
            // Load the model
            $this->load->model('reservation/VdoModel');
            
    
            // Get today's date or use the date passed by the user
            $current_date = date('Y-m-d'); 
            $stage = $this->config->item('stage');
		if($stage == "Development"){
			$current_time = $this->config->item('fixed_time');
		}else{
			$current_time = date("H:i");
		}
            // Get the reserved slots from the model
            $reservedSlots = $this->VdoModel->get_reserved_slots($current_date, $r_id);
           
            // Define all possible slots
            
            // $allSlots = [
            //     '09:00-12:00',
            //     '12:00-15:00',
            //     '15:00-16:00',
            //     ];
           $allSlots = $this->get_all_time(2);
            
            // Remove slots that have already passed
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
            $closest_time = $this->get_closest_available_slot($availableSlots,$reservedSlots,$current_time);
            // Return available slots as JSON
            echo json_encode([
                'availableSlots' => array_values($availableSlots), // Available slots
                'rows_fromtable' => $reservedSlotRanges, // Reserved slots
                'date' => $current_date,
                'closest_time'=>$closest_time
            ]);
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in fetch_available_slots: ' . $e->getMessage());
            // Return a JSON response with an error message
            echo json_encode(['error' => 'An error occurred while fetching the available slots.']);
        }
    }
    public function checkReserv($r_id)
    {
        $this->load->model('reservation/VdoModel');
        $this->load->model('Vdo_service_Model');
        $serviceModel = $this->Vdo_service_Model;

        $model = $this->VdoModel;
        $reserveds = $model->get_reserved($r_id, 'actived');
        foreach ($reserveds as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['st_id']);
            $service = $this->Vdo_service_Model->get_by_id($reserved['s_id']);
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
        
            // Store fullname in the correct entry inside the array
            $reserveds[$key]['fullname'] = $fullname;
            $reserveds[$key]['service'] = $service;
        }
        
        return $this->Render("checkroom/table.php", [
            'rows' => $reserveds,
            'title' => 'Check Reserved',
            'page' => 'vdo',
            'table' => 'vdo'
        ]);
    }

    protected function get_closest_available_slot($allSlots, $reservedSlots, $currentTime)
    {
        $closestSlot = null;
        $smallestDiff = PHP_INT_MAX; // Initialize with a large number
    
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
