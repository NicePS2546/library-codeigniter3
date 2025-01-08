<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Music extends CI_Controller
{

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
    public function reserv($r_id){
        return $this->Render('music_reserv',[
            'title'=>'Reservation',
            'r_id'=>$r_id,
            'page'=>'music'
        ]);
    }
}
