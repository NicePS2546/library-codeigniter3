<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mini extends CI_Controller
{

    public function index()
    {
        $this->load->model('RoomMini');
        $model = $this->RoomMini;
        $data = $model->getAllRoom();
        $this->load->model('reservation/MiniModel');
        $reservModel = $this->MiniModel;
        return $this->Render("mini", [
            'title' => 'Mini-Theater',
            'rooms' => $data,
            'page' => 'mini',
            'model'=> $reservModel
        ]);

    }

    public function reserv_page($r_id)
    {
        return $this->Render('reservation/music', [
            'title' => 'Reservation',
            'r_id' => $r_id,
            'page' => 'mini',
            
        ]);
    }
    public function reserv()
    {
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;
        $this->load->model('reservation/VdoModel');
        $vdoModel = $this->VdoModel;
        $this->load->model('statistic/StatisticModel');
        $statistic = $this->StatisticModel;


        $extension = "index.php/";
        $r_id = $this->input->post('r_id');  // Room number
        $st_id = $this->input->post('st_id');        // Student ID
        $total_pp = $this->input->post('total');     // Total people

        $time_slot = $this->input->post('time_slot'); // Selected time slot
        $currentDate = date('Y-m-d');  // Get the current date

        $stage = $this->config->item('stage');
        if ($stage == "Development") {
            $currentTime = $this->config->item('fixed_time');
        } else {
            $currentTime = date('H:i');  // Get the current time
        }


        // Convert the selected time range (e.g., '09:00-10:00') to start_time and exp_time
        list($start_time, $exp_time) = explode('-', $time_slot);
        $music_dupl = $model->check_duplicate($st_id, $r_id);
        $vdo_dupl = $vdoModel->check_duplicate($st_id, $r_id);
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
        $sweet = '';
        $day = getDay(date("Y-m-d H:i"));
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
        } else if ($currentTime < "08:00") {
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

        if ($music_dupl || $vdo_dupl) {
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
        $result = transaction($this->db,$model->reserve($data),$statistic->updateDailyStatistics(1, $total_pp, 1));

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
}
