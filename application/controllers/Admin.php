<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index(){
        return $this->AdminRender('admin/home',[]);
    }
    public function test(){
        
        echo $this->load->view('Template/admin/test',[],true);
    }
}