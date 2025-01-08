<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		$this->load->library('session');
		$this->session->set_userdata('userdata','Hi');
		$userdata = $this->session->userdata('userdata');
		
		return $this->Render('welcome_message',[
			'title'=>'home',
			'userdata'=>$userdata,
			'page'=>'home']);
		
	}
}
