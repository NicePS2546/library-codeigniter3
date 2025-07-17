<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Debug extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RoomMusic');
        $this->load->model('RoomVdo');
        $this->load->model('RoomMini');
        $this->load->helper('date');
    }

    public function index()
    {
        
        return $this->Render('debug', [
            "title" => "Debug",
            'page' => 'Debug'
        ]);
    }

    public function testSweetAlert()
    {
        return $this->Render('sweet', [
            "title" => "Debug",
            'page' => 'Debug'
        ]);
    }
    public function insert_data()
    {
        $selected = $this->input->post('room_t');
        $room_n = $this->input->post('room_n');
        $room_status = $this->input->post('room_status');
        $room_d = $this->input->post('room_d');

        $data = [
            'r_number' => $room_n,
            'r_status' => $room_status,
            'r_desc' => $room_d,
        ];

        switch ($selected) {
            case 'music':
                $this->check_room('RoomMusic', $room_n, $data);
                break;
            case 'vdo':
                $this->check_room('RoomVdo', $room_n, $data);
                break;
            case 'mini':
                $this->check_room('RoomMini', $room_n, $data);
                break;
            default:
                echo "Selected value error";
                break;
        }
    }

    
    
    
    public function test_upload_page(){
       return $this->Render('test_upload_page',[]);
    }
    public function test_upload() {
       
        $this->upload_image('vdo', 1);
    }
    
    public function upload_img() {
        $result = $this->upload_image('music',1);
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result['status']){
            echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "เพิ่มข้อมูลสำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    })}, 1000);
                    </script>';
        } else {
           
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เพิ่มข้อมูลไม่สำเร็จ",
                    showConfirmButton: true,
                    // timer: 1500
                })}, 1000);
                </script>';
        }
    }

    private function check_room($model, $value, $data)
    {
        $extension_url = "index.php/";
        $this->load->model($model);
        $model = $this->$model;
        $row = $model->getRoomByNumber($value);
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($row) {
            
            echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "มีหมายเลขห้อง '.$value.' อยู่แล้ว",
                    showConfirmButton: true,
                    // timer: 1500
                }).then(function() {
                window.location = "'.base_url().$extension_url.'debug"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                
            });
                }, 1000);
                </script>';
        } else {
            $result = $model->insertRoom($data);
        
            if ($result){
                echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "เพิ่มข้อมูลสำเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "'.base_url().$extension_url.'debug"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                        
                    });
                        }, 1000);
                        </script>';
            } else {
               
                echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "เพิ่มข้อมูลไม่สำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "'.base_url().$extension_url.'debug"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    
                });
                    }, 1000);
                    </script>';
            }
        }
        
    }

    public function fetchAllRooms()
    {
        $type = $this->input->post('type');

        $model = null;

        switch ($type) {
            case 'music':
                $model = 'RoomMusic';
                break;
            case 'vdo':
                $model = 'RoomVdo';
                break;
            case 'mini':
                $model = 'RoomMini';
                break;
            default:
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => false, 'message' => 'Invalid room type selected.']));
                
        }

        $this->load->model($model);
        $model = $this->$model;
        $rooms = $model->getAllRoom();

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($rooms));
    }

    public function delete_room($type,$id)
    {
       
        $model = null;

        switch ($type) {
            case 'music':
                $modelName = 'RoomMusic';
                break;
            case 'vdo':
                $modelName = 'RoomVdo';
                break;
            case 'mini':
                $modelName = 'RoomMini';
                break;
            default:
                break;
            
        }

       $model = $this->Model('',$modelName,false);
       $result = $model->deleteRoom($id);
       
    }

    public function status_modify()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $status = $this->input->post('r_status');

        if (!$id || !$type) {
            redirect('debug', 'refresh');
        }

        $model = null;

        switch ($type) {
            case 'music':
                $model = 'RoomMusicModel';
                break;
            case 'vdo':
                $model = 'RoomVdoModel';
                break;
            case 'mini':
                $model = 'RoomMiniModel';
                break;
            default:
                redirect('debug', 'refresh');
                return;
        }

        $this->load->model($model);
        $data = ['r_status' => $status];

        if ($this->$model->update_room($id, $data)) {
            redirect('music', 'refresh');
        } else {
            redirect('debug', 'refresh');
        }
    }

    public function timeTest()
    {
        $date = $this->input->post('date_time');
        $this->load->helper('date');
        if (empty($date)) {
            echo json_encode(['status' => 'error', 'message' => 'date_time parameter is missing']);
            return;
        }

        $currentDate = date('Y-m-d');
        $currentDay = getDay($currentDate);
        $day = getDay($date);

        echo json_encode([
            'status' => 'success',
            'date_received' => $date,
            'day' => $day,
            "is$currentDay" => $day == $currentDay
        ]);
    }
}
