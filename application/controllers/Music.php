<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Music extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model('reservation/MusicModel');
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
    public function reserv_page($r_number)
    {
        return $this->Render('music_reserv', [
            'title' => 'Reservation',
            'r_number' => $r_number,
            'page' => 'music'
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


}
