<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mini extends CI_Controller
{

    public function index()
    {
        $this->load->model('RoomMini');
        $model = $this->RoomMini;
        $data = $model->getAllRoom();
        
        return $this->Render("mini", [
            'title' => 'Mini-Theater',
            'rooms' => $data,
            'page' => 'mini'
        ]);

    }
    public function reserv($r_id){
        return $this->Render('music_reserv',[
            'title'=>'Reservation',
            'r_id'=>$r_id,
            'page'=>'music'
        ]);
    }
}
