<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		
		$this->load->library('session');
		// $this->session->set_userdata('userdata',[
		// 	'test'=>[
		// 		'test_data'=>1
		// 	],
		// ]);
		// $userdata = $this->session->userdata('userdata');
		// $this->check_expire();
	
		return $this->homeRender('welcome_message',[
			'title'=>'home',
			'page'=>'home']);
		
	}

	public function check_expire(){
		$this->load->model('reservation/MusicModel');
		$model = $this->MusicModel;
		$currentDate = date("Y-m-d");
		$rows = $model->get_past_reservations($currentDate);
		$model->expire_reserv($rows);
		return $rows;
	}
}
