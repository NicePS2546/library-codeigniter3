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
            'page'=>'reserv_data'
        ]);
    }
    public function reserv_music(){
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
            'rows'=>$rows
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
            'rows'=>$rows
        ]);
    }
    public function reserv_mini(){
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
            'table'=>'mini',
            'rows'=>$rows
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
}