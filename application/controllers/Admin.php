<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index(){
        $this->load->model('statistic/StatisticModel');
        $this->load->model('OnlineUser_model');
        $statistic = $this->StatisticModel;
        $online_model = $this->OnlineUser_model;
        $music = $statistic->get_by_service(1);
        $vdo = $statistic->get_by_service(2);
        $mini = $statistic->get_by_service(3);
        $currentUsers = $online_model->get_online_users();

        $statistic = [
            'music' => $music,
            'vdo' => $vdo,
            'mini' => $mini,
        ];
        
        return $this->AdminRender('admin/home',[
            "title"=>"สถิติประจำวัน",
            'page'=>'home',
            'statistic'=>$statistic,
            'currentUsers'=>$currentUsers
        ]);
    }
    public function reserv_data(){
        return $this->AdminRender('admin/reserv_data',[
            'title'=>'ข้อมูลการจอง',
            'page'=>'reserv_data',
            
        ]);
    }

    public function reserv_music(){
        $expired_rows = $this->get_expired();
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;
        $rows = $model->get_all_reserved('actived');
        foreach ($rows as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['st_id']);
            
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
        
            // Store fullname in the correct entry inside the array
            $rows[$key]['fullname'] = $fullname;
        }

        return $this->AdminRender('admin/reserv_data',[
            'title'=>'ข้อมูลการจอง',
            'page'=>'reserv_data',
            'table'=>'music',
            'rows'=>$rows,
            'expired_rows'=>$expired_rows
           
        ]);
    }
    public function reserv_vdo(){
        $this->load->model('reservation/VdoModel');
        $model = $this->VdoModel;
        $rows = $model->get_all_reserved('actived');
        foreach ($rows as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['st_id']);
            
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
        
            // Store fullname in the correct entry inside the array
            $rows[$key]['fullname'] = $fullname;
        }

        return $this->AdminRender('admin/reserv_data',[
            'title'=>'ข้อมูลการจอง',
            'page'=>'reserv_data',
            'table'=>'vdo',
            'rows'=>$rows,
            
        ]);
    }
    public function reserv_mini(){
        $this->load->model('reservation/MiniModel');
        $model = $this->MiniModel;
        $rows = $model->get_all_reserved('actived');
        foreach ($rows as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['st_id']);
            
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
        
            // Store fullname in the correct entry inside the array
            $rows[$key]['fullname'] = $fullname;
        }

        return $this->AdminRender('admin/reserv_data',[
            'title'=>'ข้อมูลการจอง',
            'page'=>'reserv_data',
            'table'=>'mini',
            'rows'=>$rows,
            
        ]);
    }
    

    public function expire_music($id){
        $extension = 'index.php/';
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;
   
        $result = $model->update_expire($id);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ปิดห้องสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ปิดห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }
    public function expire_vdo($id){
        $extension = 'index.php/';
        $this->load->model('reservation/VdoModel');
        $model = $this->VdoModel;
   
        $result = $model->update_expire($id);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ปิดห้องสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/vdo"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ปิดห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/vdo"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }
    public function expire_mini($id){
        $extension = 'index.php/';
        $this->load->model('reservation/MiniModel');
        $model = $this->MiniModel;
   
        $result = $model->update_expire($id);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ปิดห้องสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/mini"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ปิดห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/mini"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }

    public function test(){
        
        echo $this->load->view('Template/admin/test',[],true);
    }

    public function edit_reserv_music($id){
        $model = $this->Model('reservation','MusicModel',true);
        $row = $model->get_reserved_sole($id);
        
        return $this->AdminRender('admin/reservation/edit/music',[
            'title'=>'แก้ไขรายละเอียดข้อมูลการจอง',
            'page'=>'reserv_data',
            'row'=>$row,
            '$url'=>'music'
        ]);
    }
    public function edit_reserv_vdo($id){
        $model = $this->Model('reservation','VdoModel',true);
        $row = $model->get_reserved_sole($id);
        
        return $this->AdminRender('admin/reservation/edit/music',[
            'title'=>'แก้ไขรายละเอียดข้อมูลการจอง',
            'page'=>'reserv_data',
            'row'=>$row,
            '$url'=>'music'
        ]);
    }
    public function edit_reserv_mini($id){
        $model = $this->Model('reservation','MiniModel',true);
        $row = $model->get_reserved_sole($id);
        
        return $this->AdminRender('admin/reservation/edit/music',[
            'title'=>'แก้ไขรายละเอียดข้อมูลการจอง',
            'page'=>'reserv_data',
            'row'=>$row,
            '$url'=>'music',
            
        ]);
    }
   public function room_data(){
    $model = $this->Model('','RoomMusic',false);
    $rows = $model->getAllRoom();


    
    return $this->AdminRender('admin/room_data/page',[
       'rows'=>$rows,
        'page'=>'room_data',
        'title'=>'ข้อมูลห้อง',
        'table'=>'music',
        

    ]);
   }
    public function update_vdo(){
        $extension = 'index.php/';
        $reserv_id = $this->post('reserv_id');
        $u_id = $this->post('u_id');
        $total = $this->post('total');
        $time = $this->post('time_slot');
        list($start_time, $exp_time) = explode('-', $time);
        $data = [
            'st_id'=>$u_id,
            'total_pp'=>$total,
            'start_time'=>$start_time,
            'exp_time'=>$exp_time,
        ];

        $model = $this->Model('reservation','MusicModel',true);
        $result = $model->update_data($reserv_id,$data); 
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');   
    }
    public function update_mini(){
        $extension = 'index.php/';
        $reserv_id = $this->post('reserv_id');
        $u_id = $this->post('u_id');
        $total = $this->post('total');
        $time = $this->post('time_slot');
        list($start_time, $exp_time) = explode('-', $time);
        $data = [
            'st_id'=>$u_id,
            'total_pp'=>$total,
            'start_time'=>$start_time,
            'exp_time'=>$exp_time,
        ];

        $model = $this->Model('reservation','MusicModel',true);
        $result = $model->update_data($reserv_id,$data); 
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');   
    }
    public function room_music() {
        $id = $this->input->post('r_id');
        
        header('Content-Type: application/json'); // Ensure JSON response
        
        try {
            
            $model = $this->Model('','RoomMusic',false);
            $row = $model->s;

            $u_data = $this->get_user_sso_by_id($row['st_id']);
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
            // Store fullname in the correct entry inside the array
            $row['fullname'] = $fullname;

            
            
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(['message' => "fail"]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in view_mini: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred while fetching data.']);
        }
    
        exit(); // Stop execution to prevent extra HTML output
    }
    public function view_mini() {
        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');
        
        header('Content-Type: application/json'); // Ensure JSON response
        
        try {
            $this->load->model('reservation/MiniModel');
            $model = $this->MiniModel;
            $row = $model->get_reserved_row_view($id,$reserv_id);

            $u_data = $this->get_user_sso_by_id($row['st_id']);
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
            // Store fullname in the correct entry inside the array
            $row['fullname'] = $fullname;

            
            
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(['message' => "fail"]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in view_mini: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred while fetching data.']);
        }
    
        exit(); // Stop execution to prevent extra HTML output
    }
    public function view_vdo() {
        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');
        
        header('Content-Type: application/json'); // Ensure JSON response
        
        try {
            $this->load->model('reservation/VdoModel');
            $model = $this->VdoModel;
            $row = $model->get_reserved_row_view($id,$reserv_id);

            $u_data = $this->get_user_sso_by_id($row['st_id']);
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
            // Store fullname in the correct entry inside the array
            $row['fullname'] = $fullname;

            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(['message' => "fail"]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in view_mini: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred while fetching data.']);
        }
    
        exit(); // Stop execution to prevent extra HTML output
    }
    public function view_music() {
        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');
        
        header('Content-Type: application/json'); // Ensure JSON response
        
        try {
            $this->load->model('reservation/MusicModel');
            $model = $this->MusicModel;
            $row = $model->get_reserved_row_view($id,$reserv_id);

            $u_data = $this->get_user_sso_by_id($row['st_id']);
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
            // Store fullname in the correct entry inside the array
            $row['fullname'] = $fullname;

            
            
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(['message' => "fail"]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error in view_mini: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred while fetching data.']);
        }
    
        exit(); // Stop execution to prevent extra HTML output
    }


    public function admin_data (){
        $model = $this->Model('','AdminModel',false);
        $rows = $model->get_all();
        foreach ($rows as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['user_id']);
            
            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';
        
            // Store fullname in the correct entry inside the array
            $rows[$key]['fullname'] = $fullname;
        }
        return $this->AdminRender('admin/admin_data/page',[
            'title'=>'ข้อมูลผู้ดูแล',
            'page'=>'admin_data',
            'table'=>'admin_data',
            'rows'=>$rows,
            
        ]);
    }
    public function add_admin(){
        $extension = 'index.php/';
        $uid =  $this->post('uid');
        $model = $this->Model('','AdminModel',false);
        $data = [
            'user_id'=>$uid,
            'admin_status'=>1,
            'role'=>'ผู้ดูแล'
        ];
        $existing_admin = $model->get_admin($uid);
        if($existing_admin) {
            $sweet = '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "มีผู้ดูแลอยู่แล้ว",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                    });
                }, 1000);
            </script>';
            return $this->sweet($sweet, 'Admin Data', 'admin');
        }

        $result = $model->insert_data($data);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "เพิ่มผู้ดูแลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เพิ่มผู้ดูแลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Admin Data', 'admin');
    }

    public function suspend_admin($id){
        $extension = 'index.php/';
        $model = $this->Model('','AdminModel',false);
        $data = [
            'admin_status'=>0
        ];
        $result = $model->update_admin($id,$data);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ปิดใช้งานผู้ดูแลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ปิดใช้งานผู้ดูแลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Admin Data', 'admin');
    
    }
    public function active_admin($id){
        $extension = 'index.php/';
        $model = $this->Model('','AdminModel',false);
        $data = [
            'admin_status'=>1
        ];
        $result = $model->update_admin($id,$data);
        if($result){
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "เปิดใช้งานผู้ดูแลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
           
        }else{
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เปิดใช้งานผู้ดูแลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/admin_data"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Admin Data', 'admin');
    
    }

    public function get_expired()
    {
        $music = $this->Model('reservation', 'MusicModel', true);
        $vdo = $this->Model('reservation', 'VdoModel', true);
        $mini = $this->Model('reservation', 'MiniModel', true);
        

        $music_expired = $music->get_all_reserved_expired('expired');
        $vdo_expired = $vdo->get_all_reserved_expired('expired');
        $mini_expired = $mini->get_all_reserved_expired('expired');

        $rows = array_merge($music_expired, $vdo_expired, $mini_expired);

        return $rows;
    }
    
}