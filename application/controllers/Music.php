<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Music extends MY_Controller
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
        $inServiceTime = $this->checkSystemTime();

        $systemTime = $this->Model('', 'System_time_model', false)->getTimeById(1);

        $stage = $this->config->item('stage');
        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
            $currentDate = $this->config->item('fixed_date');
            $currentDateTime = "$currentDate $currentTime";
        } else {
            $currentTime = date('H:i:s');  // Get the current time
            $currentDate = date('Y-m-d');
        }

        $holiday = $this->get_holiday($currentDate);
        // print_r($inServiceTime);
        // exit();
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
            },
            'isHoliday' => $holiday ? true : false
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
        $sys_time = $this->getTimeSystem(1);
        $sys_time = $sys_time['data'];

        $extension = "index.php/";
        $r_id = $this->input->post('r_id');  // Room number
        $st_id = $this->input->post('st_id');        // Student ID
        $total_pp = $this->input->post('total');     // Total people

        $time_slot = $this->input->post('time_slot'); // Selected time slot
        $currentDateTime = date('Y-m-d H:i:s');  // Get the current date

        $stage = $this->config->item('stage');
        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
            $currentDate = $this->config->item('fixed_date');
            $currentDateTime = "$currentDate $currentTime";
        } else {
            $currentTime = date('H:i:s');  // Get the current time
            $currentDate = date('Y-m-d');
        }


        // Convert the selected time range (e.g., '09:00-10:00') to start_time and exp_time
        list($start_time, $exp_time) = explode('-', $time_slot);
        $music_dupl = $musicModel->check_duplicate($st_id, $r_id);
        $vdo_dupl = $vdoModel->check_duplicate($st_id, $r_id);
        $mini_dupl = $miniModel->check_duplicate($st_id, $r_id);

        $music_day_dupl = $musicModel->check_day_duplicate($st_id, $r_id);
        // $vdo_day_dupl = $vdoModel->check_day_duplicate($st_id, $r_id);
        // $mini_day_dupl = $miniModel->check_day_duplicate($st_id, $r_id);
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
            'created_at' => $currentDateTime,
            'update_at' => $currentDateTime
        ];

        $sweet = '';
        $day = getDay($currentDate);
        $holiday = $this->get_holiday($currentDate);
        $textHoliday = $holiday ? 'ไม่อยู่ในเวลาทำการหยุดวัน' . $holiday['title'] : 'ไม่อยู่ในเวลาทำการหยุดวันเสาร์';
        if ($day == "Saturday" || $holiday) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ขออภัยในความไม่สะดวก",
                    text:"' . $textHoliday . '",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        }

        // echo "<pre>";
        // echo $currentTime. "<br>";
        // print_r($sys_time['start_sys_time']);
        // echo "</pre>";
        // exit();

        if ($currentTime > $sys_time['end_sys_time']) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ1",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails
        } else if ($currentTime < $sys_time['start_sys_time']) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ไม่อยู่ในเวลาทำการ2",
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

        if ($music_day_dupl) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ขออภัย",
                    text: "ใช้บริการห้อง Music ได้วันละ 1 ครั้ง",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');  // Stop execution if validation fails

        }

        $result = $musicModel->reserve($data);
        $table = 'music';
        $log_model = $this->Model('', "Log_Model", false);
        $data = [
            'reserv_id' => $result,
            'r_service' => $table,
            'action_type' => 'create',
            'reason' => '',
            'perform_by' => 'user'
        ];

        $logging = $log_model->insert($data);
        if (!$logging) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "logging Error !",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url() . $extension . 'music/"; 
                });
            }, 1000);
            </script>';
            return $this->sweet($sweet, 'Music Reservation', 'music');

        }

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
        if ($this->config->item('is_use_vpn') == true) {
            $u_data = $this->get_user_sso_by_id($uid);
            $user_id = $u_data[0]['uid'][0];
            $fullname = $u_data[0]['cn'][0];
        } else {
            $u_data = true;
            $user_id = $this->config->item('set_user_id');
            $fullname = 'No Vpn Provided';
        }

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
        if ($this->config->item('is_use_vpn') == true) {
            foreach ($reserveds as $key => $reserved) {
                $u_data = $this->get_user_sso_by_id($reserved['st_id']);

                // Ensure $u_data exists and has the expected structure
                $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';

                // Store fullname in the correct entry inside the array
                $reserveds[$key]['fullname'] = $fullname;
            }
        } else {
            foreach ($reserveds as $key => $reserved) {

                // Store fullname in the correct entry inside the array
                $reserveds[$key]['fullname'] = "No Vpn Provived";
            }
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
