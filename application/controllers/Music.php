<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Music extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
       
    }
    public function index()
    {
        $this->load->model('RoomMusic');
        $model = $this->RoomMusic;
        $data = $model->getAllRoom();

        $this->load->model('reservation/MusicModel');
        $reservModel = $this->MusicModel;
      

        return $this->Render("music", [
            'title' => 'Music-Relax',
            'rooms' => $data,
            'page' => 'music',
            'model'=> $reservModel
        ]);

    }
    public function reserv_page($r_id)
    {

        $currentDate = date("Y-m-d");
        $currentDate = date("2025-01-12");

        $isBusy = $this->check_current_time_slot($currentDate,$r_id);
        return $this->Render('reservation/music', [
            'title' => 'Reservation',
            'r_id' => $r_id,
            'page' => 'music',
            'isBusy' => $isBusy
        ]);
    }
    public function reserv() {
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;
        
       
        $extension = "index.php/";
        $r_id = $this->input->post('r_id');  // Room number
        $st_id = $this->input->post('st_id');        // Student ID
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
        $row = $model->check_duplicate($st_id,$r_id);
        $data = [
            'st_id' => $st_id,  // Example: Replace with actual student/user ID
            'r_id' => $r_id, // Room number
            'total_pp' => $total_pp,  // Total people
            'start_time' => $start_time,
            'exp_time' => $exp_time,
            'r_date' => $currentDate,
            'r_status' => 'actived', // Status of the reservation
            'r_verify' => 0,  // Verification flag (0 for unverified)
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        ];
    
        
        if($currentTime > "16:00"){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }else if($currentTime < "09:00"){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ",
                    showConfirmButton: true,
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }
        

        // Check if the room number and other inputs are valid
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if (!$r_id || !$st_id || !$total_pp || !$time_slot) {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/reserv/' . $r_id . '"; 
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }else if($total_pp < 4){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนคนน้อยกว่าที่กำหนด",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/reserv/' . $r_id . '"; 
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }else if($total_pp > 7){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนคนมากกว่าที่กำหนด",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/reserv/' . $r_id . '"; 
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }
        
        if($row){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จำนวนการจองเกินกำหนด 1 ผู้ใช้ ต่อ 1 การจอง",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return;  // Stop execution if validation fails
        }
        
        $result = $model->reserve($data);
    
        if ($result) {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "จองห้องสำเร็จ!",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/"; 
                });
            }, 1000);
            </script>';
        } else {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "จองห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/reserv/' . $r_id . '"; 
                });
            }, 1000);
            </script>';
        }
            
    }
    

    public function get_availible_slots($r_id) {
        try {
            // Load the model
            $this->load->model('reservation/MusicModel');
    
            // Get today's date or use the date passed by the user
            $current_date = date('Y-m-d'); 
            $stage = $this->config->item('stage');
		if($stage == "Development"){
			$current_time = $this->config->item('fixed_time');
		}else{
			$current_time = date("H:i");
		}
            // Get the reserved slots from the model
            $reservedSlots = $this->MusicModel->get_reserved_slots($current_date, $r_id);
            

            // Define all possible slots
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
            $closest_time = $this->get_closest_available_slot($allSlots,$reservedSlots,$current_time);
            
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
    
    public function test(){
        $time = $this->input->post('time_slot');
        echo $time;
    }
    public function check_availability() {
        $model = $this->RoomMusic;
        // Get selected time slot from form input
        $selectedSlot = $this->input->post('time_slot');
        $r_date = $this->input->post('r_date'); // Get the reservation date

        // Extract start and end times from the selected slot
        list($startTime, $endTime) = explode('-', $selectedSlot);

        // Check if the selected time slot is available
        $isAvailable = $model->check_availability($startTime, $endTime, $r_date);

        if ($isAvailable) {
            // Proceed with reservation if available
            $model->reserve($startTime, $endTime, $r_date);
            echo "Reservation successful!";
        } else {
            echo "The selected time slot is already reserved.";
        }
    }



    public function check_current_time_slot($currentDate,$r_id) {
        // Get the current date and time
        $currentDate = date('Y-m-d'); // Current date (e.g., 2025-01-12)
        $currentTime = date('H:i'); // Current time (e.g., 11:37)
        $currentTime = "11:37"; // Current time (e.g., 11:37)
    
        // Load the model
        $this->load->model('reservation/MusicModel');
    
        // Get the reserved slots for today where r_verify is true
        $reservedSlots = $this->MusicModel->get_reserved_slots($currentDate,$r_id);
    
        // Check if the current time falls within any reserved slot
        foreach ($reservedSlots as $slot) {
            // Convert start and end times to time format
            $start_time = date('H:i', strtotime($slot['start_time']));
            $exp_time = date('H:i', strtotime($slot['exp_time']));
    
            // Check if the current time is within this range
            if ($currentTime >= $start_time && $currentTime <= $exp_time && $slot['r_verify'] == 1) {
                // The current time is within a reserved and verified slot
                return "The current time ($currentTime) is within a reserved and verified slot!";
                
            }
        }
    
        // If no match is found, the current time is not within any reserved slot
        return "The current time ($currentTime) is not within any reserved and verified slot.";
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
