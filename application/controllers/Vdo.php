<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vdo extends CI_Controller
{

    public function index()
    {
        $this->load->model('RoomVdo');
        $model = $this->RoomVdo;
        $data = $model->getAllRoom();
        return $this->Render("vdo", [
            'title' => 'Video On-Demand',
            'rooms' => $data,
            'page' => 'vdo'
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
