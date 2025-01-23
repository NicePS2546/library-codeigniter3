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
    public function reserv_page($r_id){
        $this->load->model('Vdo_service_Model');
        $model = $this->Vdo_service_Model;
        $services = $model->get_all();

        return $this->Render('reservation/vdo/vdo_service',[
            'title'=>'VDO Service',
            'r_id' =>$r_id,
            'services'=>$services,
            'page'=>'vdo'
        ]);
    }
}
