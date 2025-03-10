<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
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

        return $this->AdminRender('admin/home', [
            "title" => "สถิติประจำวัน",
            'page' => 'home',
            'statistic' => $statistic,
            'currentUsers' => $currentUsers
        ]);
    }
    public function reserv_data()
    {

        return $this->AdminRender('admin/reserv_data', [
            'title' => 'ข้อมูลการจอง',
            'page' => 'reserv_data',

        ]);
    }

    public function reserv_music()
    {
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

        return $this->AdminRender('admin/reserv_data', [
            'title' => 'ข้อมูลการจอง',
            'page' => 'reserv_data',
            'table' => 'music',
            'rows' => $rows,
            'expired_rows' => $expired_rows,
            'get_type' => function ($r_s_id) {
                return $this->get_type_byId($r_s_id);
            }

        ]);
    }
    public function reserv_vdo()
    {
        $expired_rows = $this->get_expired();
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

        return $this->AdminRender('admin/reserv_data', [
            'title' => 'ข้อมูลการจอง',
            'page' => 'reserv_data',
            'table' => 'vdo',
            'rows' => $rows,
            'expired_rows' => $expired_rows,
            'get_type' => function ($r_s_id) {
                return $this->get_type_byId($r_s_id);
            }
        ]);
    }

    public function reserv_mini()
    {
        
        $expired_rows = $this->get_expired();
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

        return $this->AdminRender('admin/reserv_data', [
            'title' => 'ข้อมูลการจอง',
            'page' => 'reserv_data',
            'table' => 'mini',
            'rows' => $rows,
            'expired_rows' => $expired_rows,
            'get_type' => function ($r_s_id) {
                return $this->get_type_byId($r_s_id);
            }
        ]);
    }


    public function expire_music($id)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $this->load->model('reservation/MusicModel');
        $model = $this->MusicModel;

        $result = $model->update_expire($id);
        if ($result) {
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

        } else {
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
    public function expire_vdo($id)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $this->load->model('reservation/VdoModel');
        $model = $this->VdoModel;

        $result = $model->update_expire($id);
        if ($result) {
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

        } else {
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
    public function expire_mini($id)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $this->load->model('reservation/MiniModel');
        $model = $this->MiniModel;

        $result = $model->update_expire($id);
        if ($result) {
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

        } else {
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

    public function test()
    {

        echo $this->load->view('Template/admin/test', [], true);
    }

    public function edit_reserv_music($id)
    {
       
        $model = $this->Model('reservation', 'MusicModel', true);
        $row = $model->get_reserved_sole($id);

        return $this->AdminRender('admin/reservation/edit/music', [
            'title' => 'แก้ไขรายละเอียดข้อมูลการจอง',
            'page' => 'reserv_data',
            'row' => $row,
            '$url' => 'music'
        ]);
    }
    public function edit_reserv_vdo($id)
    {
        $model = $this->Model('reservation', 'VdoModel', true);
        $row = $model->get_reserved_sole($id);

        return $this->AdminRender('admin/reservation/edit/music', [
            'title' => 'แก้ไขรายละเอียดข้อมูลการจอง',
            'page' => 'reserv_data',
            'row' => $row,
            '$url' => 'music'
        ]);
    }
    public function edit_reserv_mini($id)
    {
       
        $model = $this->Model('reservation', 'MiniModel', true);
        $row = $model->get_reserved_sole($id);

        return $this->AdminRender('admin/reservation/edit/music', [
            'title' => 'แก้ไขรายละเอียดข้อมูลการจอง',
            'page' => 'reserv_data',
            'row' => $row,
            '$url' => 'music',

        ]);
    }
    public function room_data($type)
    {
       
        $model = null;
        switch ($type) {
            case 'music':
                $model = $this->Model('', 'RoomMusic', false);
                $room_title = 'Music-Relax';
                $table = 'music';
                break;
            case 'vdo':
                $model = $this->Model('', 'RoomVdo', false);
                $room_title = 'Video On-Demand';
                $table = 'vdo';
                break;
            case 'mini':
                $model = $this->Model('', 'RoomMini', false);
                $room_title = 'Mini-Theater';
                $table = 'mini';
                break;
            default:
                $model = $this->Model('', 'RoomMusic', false);
                $table = 'music';
                $room_title = 'Music-Relax';
                break;
        }
        $rows = $model->getAllRoom();
        return $this->AdminRender('admin/room_data/page', [
            'rows' => $rows,
            'page' => 'room_data',
            'title' => 'ข้อมูลห้อง',
            'table' => $table,
            'room_title' => $room_title


        ]);
    }
    public function update_vdo()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $reserv_id = $this->post('reserv_id');
        $u_id = $this->post('u_id');
        $total = $this->post('total');
        $time = $this->post('time_slot');
        list($start_time, $exp_time) = explode('-', $time);
        $data = [
            'st_id' => $u_id,
            'total_pp' => $total,
            'start_time' => $start_time,
            'exp_time' => $exp_time,
        ];

        $model = $this->Model('reservation', 'MusicModel', true);
        $result = $model->update_data($reserv_id, $data);
        if ($result) {
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

        } else {
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
    public function update_mini()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $reserv_id = $this->post('reserv_id');
        $u_id = $this->post('u_id');
        $total = $this->post('total');
        $time = $this->post('time_slot');
        list($start_time, $exp_time) = explode('-', $time);
        $data = [
            'st_id' => $u_id,
            'total_pp' => $total,
            'start_time' => $start_time,
            'exp_time' => $exp_time,
        ];

        $model = $this->Model('reservation', 'MusicModel', true);
        $result = $model->update_data($reserv_id, $data);
        if ($result) {
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

        } else {
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
    public function edit_room_page($type,$r_id){
        
        switch ($type) {
            case 'music':
                $model = $this->Model('', 'RoomMusic', false);
                $room_title = 'Music-Relax';
                $url = 'music';
                break;
            case 'vdo':
                $model = $this->Model('', 'RoomVdo', false);
                $room_title = 'Video On-Demand';
                $url = 'vdo';
                break;
            case 'mini':
                $model = $this->Model('', 'RoomMini', false);
                $room_title = 'Mini-Theater';
                $url = 'mini';
                break;
            default:
                $model = $this->Model('', 'RoomMusic', false);
                $url = 'music';
                $room_title = 'Music-Relax';
                break;
        }
        $row = $model->getRowById($r_id);
        return $this->AdminRender('admin/room_data/room/edit/page',[
            'title'=>'แก้ไขข้อมูลห้อง',
            'url'=>$url,
            'row'=>$row,
            'type'=>$type,
            'r_id'=>$r_id,
            'page'=>'room_data'
        ]);
    }
    public function add_room_page($type){
        return $this->AdminRender('admin/room_data/room/add/page',[
            'title'=>'เพิ่มข้อมูลห้อง',
            'type'=>$type,
             'page'=>'room_data'
        ]);
    }

    public function edit_room_submit()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }

        $extension = 'index.php/';
        $type = $this->post('type');
        $r_id = $this->post('r_id');
        $r_number = $this->post('r_numb');
        $r_status = $this->post('r_status');
        $r_close_desc = $this->post('r_close_desc');
        $r_desc = $this->post('r_desc');
      
        $upload_img = $this->upload_image($type,$r_number,'img');
        
        $img_name = $upload_img['img_name'];

        $data = [
            'r_number' => $r_number,
            'r_status' => $r_status,
            'r_close_desc' => $r_close_desc,
            'r_desc' => $r_desc,
        ];
        if($img_name){
           $data['r_img'] = $img_name;
        }

        switch ($type) {
            case 'music':
                $model = $this->Model('', 'RoomMusic', false);
                $room_title = 'Music-Relax';
                $table = 'music';
                break;
            case 'vdo':
                $model = $this->Model('', 'RoomVdo', false);
                $room_title = 'Video On-Demand';
                $table = 'vdo';
                break;
            case 'mini':
                $model = $this->Model('', 'RoomMini', false);
                $room_title = 'Mini-Theater';
                $table = 'mini';
                break;
            default:
                $model = $this->Model('', 'RoomMusic', false);
                $table = 'music';
                $room_title = 'Music-Relax';
                break;
        }
       
        $result = $model->updateRoom($data,$r_id);
        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/room_data/'.$type.'"; 
                });
            }, 1000);
            </script>';

        } else {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/room_data/'.$type.'"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }

    public function add_room_submit()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }

        $extension = 'index.php/';
        $type = $this->post('type');
      
        $r_number = $this->post('r_numb');
        $r_status = $this->post('r_status');
        $r_close_desc = $this->post('r_close_desc');
        $r_desc = $this->post('r_desc');
      
        $upload_img = $this->upload_image($type,$r_number,'img');
        
        $img_name = $upload_img['img_name'];

        $data = [
            'r_number' => $r_number,
            'r_status' => $r_status,
            'r_close_desc' => $r_close_desc,
            'r_desc' => $r_desc,
        ];
        if($img_name){
           $data['r_img'] = $img_name;
        }

        switch ($type) {
            case 'music':
                $model = $this->Model('', 'RoomMusic', false);
                $room_title = 'Music-Relax';
                $table = 'music';
                break;
            case 'vdo':
                $model = $this->Model('', 'RoomVdo', false);
                $room_title = 'Video On-Demand';
                $table = 'vdo';
                break;
            case 'mini':
                $model = $this->Model('', 'RoomMini', false);
                $room_title = 'Mini-Theater';
                $table = 'mini';
                break;
            default:
                $model = $this->Model('', 'RoomMusic', false);
                $table = 'music';
                $room_title = 'Music-Relax';
                break;
        }
       
        $result = $model->insertRoom($data);
        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "เพิ่มข้อมูลห้องสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/room_data/'.$type.'"; 
                });
            }, 1000);
            </script>';

        } else {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เพิ่มข้อมูลห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/room_data/'.$type.'"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }

    public function room_view_data($type)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        switch ($type) {
            case 'music':
                $model = $this->Model('', 'RoomMusic', false);
                break;
            case 'vdo':
                $model = $this->Model('', 'RoomVdo', false);
                break;
            case 'mini':
                $model = $this->Model('', 'RoomMini', false);
                break;
            default:
                $model = null;
                break;
        }

        $id = $this->input->post('r_id');

        header('Content-Type: application/json'); // Ensure JSON response

        try {


            $row = $model->getRowById($id);

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
    public function view_mini()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');

        header('Content-Type: application/json'); // Ensure JSON response

        try {
            $this->load->model('reservation/MiniModel');
            $model = $this->MiniModel;
            $row = $model->get_reserved_row_view($id, $reserv_id);

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
    public function view_vdo()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');

        header('Content-Type: application/json'); // Ensure JSON response

        try {
            $this->load->model('reservation/VdoModel');
            $model = $this->VdoModel;
            $row = $model->get_reserved_row_view($id, $reserv_id);

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
    public function view_music()
    {

        $id = $this->input->post('id');
        $reserv_id = $this->input->post('reserved_id');

        header('Content-Type: application/json'); // Ensure JSON response

        try {
            $this->load->model('reservation/MusicModel');
            $model = $this->MusicModel;
            $row = $model->get_reserved_row_view($id, $reserv_id);

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


    public function admin_data()
    {
        $model = $this->Model('', 'AdminModel', false);
        $rows = $model->get_all();
        foreach ($rows as $key => $reserved) {
            $u_data = $this->get_user_sso_by_id($reserved['user_id']);

            // Ensure $u_data exists and has the expected structure
            $fullname = isset($u_data[0]['cn'][0]) ? $u_data[0]['cn'][0] : 'Unknown';

            // Store fullname in the correct entry inside the array
            $rows[$key]['fullname'] = $fullname;
        }
        return $this->AdminRender('admin/admin_data/page', [
            'title' => 'ข้อมูลผู้ดูแล',
            'page' => 'admin_data',
            'table' => 'admin_data',
            'rows' => $rows,

        ]);
    }
    public function add_admin()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $uid = $this->post('uid');
        $model = $this->Model('', 'AdminModel', false);
        $data = [
            'user_id' => $uid,
            'admin_status' => 1,
            'role' => 'ผู้ดูแล'
        ];
        $existing_admin = $model->get_admin($uid);
        if ($existing_admin) {
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
        if ($result) {
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
        } else {
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

    public function suspend_admin($id)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $extension = 'index.php/';
        $model = $this->Model('', 'AdminModel', false);
        $data = [
            'admin_status' => 0
        ];
        $result = $model->update_admin($id, $data);
        if ($result) {
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

        } else {
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

    public function active_admin($id)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }

        $extension = 'index.php/';
        $model = $this->Model('', 'AdminModel', false);
        $data = [
            'admin_status' => 1
        ];
        $result = $model->update_admin($id, $data);
        if ($result) {
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

        } else {
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
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $music = $this->Model('reservation', 'MusicModel', true);
        $vdo = $this->Model('reservation', 'VdoModel', true);
        $mini = $this->Model('reservation', 'MiniModel', true);


        $music_expired = $music->get_all_reserved_expired('expired');
        $vdo_expired = $vdo->get_all_reserved_expired('expired');
        $mini_expired = $mini->get_all_reserved_expired('expired');

        $rows = array_merge($music_expired, $vdo_expired, $mini_expired);

        return $rows;
    }
    public function update_expired_batch($rows)
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }

        if (empty($rows)) {
            return false;
        }

        $music = $this->Model('reservation', 'MusicModel', true);
        $vdo = $this->Model('reservation', 'VdoModel', true);
        $mini = $this->Model('reservation', 'MiniModel', true);

        $music_ids = [];
        $vdo_ids = [];
        $mini_ids = [];

        foreach ($rows as $row) {
            if ($row['r_s_id'] == '1') {
                $music_ids[] = $row['reserv_id'];
            } elseif ($row['r_s_id'] == '2') {
                $vdo_ids[] = $row['reserv_id'];
            } elseif ($row['r_s_id'] == '3') {
                $mini_ids[] = $row['reserv_id'];
            }
        }

        if (!empty($music_ids)) {
            $music->batch_update_status($music_ids, 'deleted');
        }
        if (!empty($vdo_ids)) {
            $vdo->batch_update_status($vdo_ids, 'deleted');
        }
        if (!empty($mini_ids)) {
            $mini->batch_update_status($mini_ids, 'deleted');
        }

        return true;
    }

    public function delete_all()
    {
        if (!$this->check_admin()) {
            $this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
            redirect('/');
            exit();
        }
        $table = $this->post('table');
        $extension = 'index.php/';
        $expire_rows = $this->get_expired();
        $result = $this->update_expired_batch($expire_rows);

        if ($result) {
            $sweet = '<script>
        setTimeout(function() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "ลบทั้งหมดสำเร็จ",
                showConfirmButton: true,
            }).then(function(){
                 window.location = "' . base_url() . $extension . 'admin/check/reserv/' . $table . '"; 
            });
        }, 1000);
        </script>';

        } else {
            $sweet = '<script>
        setTimeout(function() {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "ลบทั้งหมดไม่สำเร็จ",
                showConfirmButton: true,
            }).then(function(){
                 window.location = "' . base_url() . $extension . 'admin/check/reserv/' . $table . '"; 
            });
        }, 1000);
        </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');
    }

    public function delete_expire($reserv_id)
    {
        $model = null;
        $s_id = $this->post('service_id');
        $result = null;
        $extension = 'index.php/';
        $table = null;
        switch ($s_id) {
            case 1:
                $model = $this->Model('reservation', 'MusicModel', true);
                $table = 'music';
                break;
            case 2:
                $model = $this->Model('reservation', 'VdoModel', true);
                $table = 'vdo';
                break;
            case 3:
                $model = $this->Model('reservation', 'MiniModel', true);
                $table = 'mini';
                break;
            default:
                $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ผิดพลาดระบบขัดข้อง",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/music"; 
                });
            }, 1000);
            </script>';
                break;
        }
        $result = $model->delete_outdate($reserv_id);

        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ลบการจองสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/' . $table . '"; 
                });
            }, 1000);
            </script>';

        } else {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ลบการจองไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . 'admin/check/reserv/' . $table . '"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Reservation Data', 'admin');

    }

    public function time_setting_page(){
        $model = $this->Model('','Time_Setting_Model',false);
        $rows = $model->getAllTime();

        return $this->AdminRender('admin/time_setting/page',[
            'title'=>'ข้อมูลเวลาห้อง',
            'page'=>'time_setting',
            'rows'=>$rows,
            'get_type' => function ($r_s_id) {
                return $this->get_type_byId($r_s_id);
            }
        ]);
    }
    public function time_setting_submit(){
        $extension = 'index.php/';
        $model = $this->Model('','Time_Setting_Model',false);
        $s_id = $this->post('s_id');
        $t_start = $this->post('t_start');
        $t_end = $this->post('t_end');
        $interval = $this->post('interval_time');
        $data= [
            'start_time'=>$t_start,
            'end_time'=>$t_end,
            'interval_hours'=>$interval
        ];
        $result = $model->updateTime($data,$s_id);

        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ตั้งค่าเวลาห้องสำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                     window.location = "' . base_url() . $extension . '/admin/time/setting"; 
                });
            }, 1000);
            </script>';

        } else {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ตั้งค่าเวลาห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function(){
                    window.location = "' . base_url() . $extension . '/admin/time/setting"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'TimeSetting', 'admin');
    }
}