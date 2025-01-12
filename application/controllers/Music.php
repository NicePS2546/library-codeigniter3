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
        return $this->Render("music", [
            'title' => 'Music-Relax',
            'rooms' => $data,
            'page' => 'music'
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
    public function reserv()
    {
        $extension = "index.php/";
        $r_number = $this->input->post('r_number');
        $st_id = $this->input->post('st_id');
        $total_pp = $this->input->post('total');
        $start_date = $this->input->post('start_date');
        $ip = $this->input->ip_address();
        if ($ip === '::1') {
            $ip = '127.0.0.1'; // Map localhost IPv6 to IPv4 for consistency
        }
        $currentDate = date('Y-m-d');
        $currentDay = getDay($currentDate);
        $day = getDay($start_date);


        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if (!$r_number) {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่มีหมายเลขห้อง",
                    showConfirmButton: true,
                    // timer: 1500
                }).then(function() {
                window.location = "' . base_url() . $extension. 'music/reserv/' . $r_number . '"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                
            });
                }, 1000);
                </script>';
        }elseif($total_pp < 4 && $total_pp < 7){
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เข้าได้ 4-7 คน",
                    showConfirmButton: true,
                    // timer: 1500
                }).then(function() {
                window.location = "' . base_url() . $extension. 'music/reserv/' . $r_number . '"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                
            });
                }, 1000);
                </script>';
        }

        if ($day == "Saturday") {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "วันเสาร์ห้องสมุดปิดจองไม่ได้",
                    showConfirmButton: true,
                    // timer: 1500
                }).then(function() {
                window.location = "' . base_url() . $extension. 'music/reserv/' . $r_number . '"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                
            });
                }, 1000);
                </script>';

        } else {
            $model = $this->MusicModel;
            
            $result = $model->reserve_room($st_id, $r_number, $total_pp, $start_date, $ip);
            if($result){
                echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "จองห้องสำเร็จ!",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "' . base_url() .$extension. 'music/reserv/' . $r_number . '"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    
                });
                    }, 1000);
                    </script>';
            }else{
                echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "จองห้องไม่สำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "' . base_url() . $extension. 'music/reserv/' . $r_number . '"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    
                });
                    }, 1000);
                    </script>';
            }
        
        }
    }




    public function get_availible_slots($r_id) {
        try {
            // Load the model
            $this->load->model('reservation/MusicModel');
    
            // Get today's date or use the date passed by the user
            $r_date = date('Y-m-d'); 
            $r_date = "2025-01-12"; 
    
            // Get the reserved slots from the model
            $reservedSlots = $this->MusicModel->get_reserved_slots($r_date,$r_id);
    
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
    
            // Filter out the reserved slots from all slots
            $reservedSlotRanges = [];

            // Loop through each reserved slot and convert it into the range format
            foreach ($reservedSlots as $slot) {
                // Assuming the reserved slot has the format '09:00:00' and '10:00:00' 
                // (start_time and exp_time from the DB)
                $reservedSlotRanges[] = date('H:i', strtotime($slot['start_time'])) . '-' . date('H:i', strtotime($slot['exp_time']));
            }
        
            // Filter out the reserved slots from the available slots
            $availableSlots = array_diff($allSlots, $reservedSlotRanges);
        
            // Return available slots as JSON
            echo json_encode([
                'availableSlots' => array_values($availableSlots), // Available slots
                'rows_fromtable' => $reservedSlotRanges, // Reserved slots
                'date' => $r_date
            ]);
    
        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in fetch_available_slots: ' . $e->getMessage());
            // Return a JSON response with an error message
            echo json_encode(['error' => 'An error occurred while fetching the available slots.']);
        }
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
}
