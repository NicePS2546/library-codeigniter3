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
        $extension = "index.php/";
        $model = $this->RoomMusic;
        $data = $model->getAllRoom();
        $this->load->model('reservation/MusicModel');
        $reservModel = $this->MusicModel;
        $isAllFull = $this->checkAllFull($data);
        if ($isAllFull) {
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "ขออภัยในความไม่สะดวก",
                    text: "ขณะนี้ห้องบริการถูกจองหมดแล้ว",
                    showConfirmButton: true,
                })
            }, 1000);
            </script>';
        }

        return $this->Render("music", [
            'title' => 'Music-Relax',
            'rooms' => $data,
            'page' => 'music',
            'model' => $reservModel,
            'aviliable_time' => function ($r_id) {
                return $this->get_availible_time_card($r_id);
            }
        ]);

    }
    public function reserv_page($r_id)
    {
        $model = $this->Model('', 'RoomMusic', false);
        $data = $model->getRoomById($r_id);

        return $this->Render('reservation/music', [
            'title' => 'Reservation',
            'r_id' => $r_id,
            'page' => 'music',
            'data' => $data,

        ]);
    }

    // public function checkAllFull($rooms)
    // {
    //     foreach ($rooms as &$room) { // <- Note the & here!
    //         $availability = $this->get_availible_time_card($room['r_id']);
    //         $room['is_full'] = empty($availability['availableSlots']) ? 1 : 0;
    //     }
    //     echo "<pre>";
    //     print_r($rooms);
    //     echo "</pre>";
    // }

    public function checkAllFull($rooms)
    {
        foreach ($rooms as &$room) {
            $availability = $this->get_availible_time_card($room['r_id']);
            $room['is_full'] = empty($availability['availableSlots']) ? 1 : 0;

            if ($room['is_full'] == 0) {
                // As soon as one room is not full, we can stop and return false
                return false;
            }
        }

        return true;
    }
    // public function check_duplicate_by_type($type, $st_id, $r_id, $models)
    // {
    //     $music_model = $models['music'];
    //     $vdo_model = $models['vdo'];
    //     $mini_model = $models['mini'];

    //     return [
    //         'music' => $this->$music_model->$type($st_id, $r_id),
    //         'vdo' => $this->$vdo_model->$type($st_id, $r_id),
    //         'mini' => $this->$mini_model->$type($st_id, $r_id),
    //     ];
    // }

    public function reserv()
    {
        $this->load->model('reservation/MusicModel');
        $musicModel = $this->MusicModel;
        $this->load->model('reservation/VdoModel');
        $vdoModel = $this->VdoModel;
        $miniModel = $this->Model('reservation', 'MiniModel', true);



        $extension = "index.php/";
        $r_id = $this->input->post('r_id');  // Room number
        $st_id = $this->input->post('st_id');        // Student ID
        $total_pp = $this->input->post('total');     // Total people

        $time_slot = $this->input->post('time_slot'); // Selected time slot
        $currentDate = date('Y-m-d H:i');  // Get the current date

        $stage = $this->config->item('stage');
        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
            $currentDate = $this->config->item('fixed_date');
        } else {
            $currentTime = date('H:i');  // Get the current time
            $currentDate = date('Y-m-d');
        }


        // Convert the selected time range (e.g., '09:00-10:00') to start_time and exp_time
        list($start_time, $exp_time) = explode('-', $time_slot);
        $music_dupl = $musicModel->check_duplicate($st_id, $r_id);
        $vdo_dupl = $vdoModel->check_duplicate($st_id, $r_id);
        $mini_dupl = $miniModel->check_duplicate($st_id, $r_id);

        $music_day_dupl = $musicModel->check_day_duplicate($st_id, $r_id);
        $vdo_day_dupl = $vdoModel->check_day_duplicate($st_id, $r_id);
        $mini_day_dupl = $miniModel->check_day_duplicate($st_id, $r_id);
        //use for testing    
        // echo "<pre>";
        // print_r($music_day_dupl);
        // echo "Hi";
        // echo "</pre>";
        // exit();
        $check_time_dul = $this->Model('reservation', 'MusicModel', true)->check_time_duplicate($r_id, $start_time, $exp_time);

        if ($check_time_dul) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เวลานี้ถูกจองไปแล้วโปรดจองใหม่อีกครั้ง",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        }

        $data = [
            'st_id' => $st_id,  // Example: Replace with actual student/user ID
            'r_id' => $r_id, // Room number
            'total_pp' => $total_pp,  // Total people
            'start_time' => $start_time,
            'exp_time' => $exp_time,
            'r_date' => $currentDate,
            'r_status' => 'actived', // Status of the reservation
            'r_verify' => 1,  // Verification flag (0 for unverified)
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        $sweet = '';
        $day = getDay($currentDate);

        if ($day == "Saturday") {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการหยุดวันเสาร์",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        }
        if ($currentTime > "16:00") {
            $sweet = '<script>
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
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        } else if ($currentTime < "09:00") {
            $sweet = '<script>
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
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
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
                    window.location = "' . base_url() . $extension . 'music/reserv/' . $r_id . '"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        } else if ($total_pp < 4) {
            $sweet = '<script>
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
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        } else if ($total_pp > 7) {
            $sweet = '<script>
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
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        }

        if ($music_dupl || $vdo_dupl || $mini_dupl) {
            $sweet = '<script>
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
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        }

        if ($music_day_dupl || $vdo_day_dupl || $mini_day_dupl) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ขออภัย",
                    text: "ใช้บริการได้วันละ 1 ครั้ง",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails

        }
        $result = $musicModel->reserve($data);

        if ($result) {
            $sweet = '<script>
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
            $sweet = '<script>
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
        return $this->sweet($sweet, 'Music Reservation', 'music');

    }

    public function get_user_sso()
    {
        $uid = $this->input->post('uid');
        $u_data = $this->get_user_sso_by_id($uid);
        $user_id = $u_data[0]['uid'][0];
        $fullname = $u_data[0]['cn'][0];
        $is_reserv = $this->input->post('reserv');
        $info = [
            'uid' => $user_id,
            'fullname' => $fullname
        ];

        if ($is_reserv == 1) {
            if ($user_id == '654230053') {
                $info['fullname'] = 'เด็กชายเปรม ยิ้มสวย บ้านอยู่หลังวัด ';
            } else if ($user_id == '654230044') {
                $info['fullname'] = 'โอ๊ต เด็กวัด ';
            } else if ($user_id == '654230042') {
                $info['fullname'] = "The Homeless Man";
            } else if ($user_id == '654230041') {
                $info['fullname'] = "ธนาปล่อยลมยาง";
            }
        }

        // <img class='rounded' height='50px' width='50px' src='".base_url('public/assets/friend/icon/easterEgg.png')."'>
        if ($u_data) {
            echo json_encode([
                'userdata' => $info,
                'message' => 'Success',
                'reserve' => $is_reserv
            ]);
        } else {
            echo json_encode([
                'message' => 'fail'
            ]);
        }
    }
    public function checkReserv($r_id)
    {
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;
        $reserveds = $model->get_reserved($r_id, 'actived');
        foreach ($reserveds as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['st_id']);

            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';

            // Store fullname in the correct entry inside the array
            $reserveds[$key]['fullname'] = $fullname;
        }

        return $this->Render("checkroom/table.php", [
            'rows' => $reserveds,
            'title' => 'Check Reserved',
            'page' => 'music',
            'table' => 'music'
        ]);
    }

    public function get_availible_slots($r_id)
    {
        try {
            // Load the model
            $this->load->model('reservation/MusicModel');

            // Get today's date or use the date passed by the user

            $stage = $this->config->item('stage');
            if ($stage == "Development") {
                $current_time = $this->config->item('fixed_time');
                $current_date = $this->config->item('fixed_date');
            } else {
                $current_time = date("H:i");
                $current_date = date('Y-m-d H:i');
            }
            // Get the reserved slots from the model
            $reservedSlots = $this->MusicModel->get_reserved_slots($current_date, $r_id);



            // Define all possible slots
            // $allSlots = [
            //     '09:00-10:00',
            //     '10:00-11:00',
            //     '11:00-12:00',
            //     '12:00-13:00',
            //     '13:00-14:00',
            //     '14:00-15:00',
            //     '15:00-16:00',
            //     // Add more slots as needed
            // ];

            $allSlots = $this->get_all_time(1);


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
            $closest_time = $this->get_closest_available_slot($availableSlots, $reservedSlots, $current_time);
            // Return available slots as JSON

            $day = getDay($current_date);

            if ($day == "Saturday") {
                echo json_encode([
                    'availableSlots' => [], // Available slots
                    'rows_fromtable' => $reservedSlotRanges, // Reserved slots
                    'date' => $current_date,
                    'closest_time' => $closest_time,
                    'message' => 'Saturday'
                ]);
            } else {
                echo json_encode([
                    'availableSlots' => array_values($availableSlots), // Available slots
                    'rows_fromtable' => $reservedSlotRanges, // Reserved slots
                    'date' => $current_date,
                    'closest_time' => $closest_time
                ]);
            }



        } catch (Exception $e) {
            // Log the error message
            log_message('error', 'Error in fetch_available_slots: ' . $e->getMessage());
            // Return a JSON response with an error message
            echo json_encode(['error' => 'An error occurred while fetching the available slots.']);
        }
    }


    public function check_availability()
    {
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



    public function check_current_time_slot($currentDate, $r_id)
    {
        // Get the current date and time
        $currentDate = date('Y-m-d'); // Current date (e.g., 2025-01-12)
        $currentTime = date('H:i'); // Current time (e.g., 11:37)

        // Load the model
        $this->load->model('reservation/MiniModel');

        // Get the reserved slots for today where r_verify is true
        $reservedSlots = $this->MiniModel->get_reserved_slots($currentDate, $r_id);

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
    public function get_availible_time_card($r_id)
    {
        try {
            // Load the model
            $this->load->model('reservation/MusicModel');

            // Get today's date or use the date passed by the user
            $current_date = date('Y-m-d');
            $stage = $this->config->item('stage');
            if ($stage == "Development") {
                $current_time = $this->config->item('fixed_time');
            } else {
                $current_time = date("H:i");
            }
            // Get the reserved slots from the model
            $reservedSlots = $this->MusicModel->get_reserved_slots($current_date, $r_id);

            $allSlots = $this->get_all_time(1);

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
            $closest_time = $this->get_closest_available_slot($availableSlots, $reservedSlots, $current_time);
            // Return available slots as JSON

            return [
                'availableSlots' => array_values($availableSlots), // Available slots
                'rows_fromtable' => $reservedSlotRanges, // Reserved slots
                'date' => $current_date,
                'closest_time' => $closest_time
            ];

        } catch (Exception $e) {
            return ['error' => "An error occurred while fetching the available slots." . $e->getMessage()];
        }
    }
}
