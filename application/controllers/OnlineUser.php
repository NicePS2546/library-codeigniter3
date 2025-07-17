<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OnlineUser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OnlineUser_model');
        $this->load->library('session');
    }

    // Function to add an online user
    public function add()
    {
        if (!$this->session->userdata('online_user')) {
            $this->OnlineUser_model->add_online_user();
            $this->session->set_userdata('online_user', TRUE);
        }
    }

    // Function to remove an online user
    public function remove()
    {
        if ($this->session->userdata('online_user')) {
            $this->OnlineUser_model->remove_online_user();
            $this->session->unset_userdata('online_user');
        }
    }

    // Function to display the number of online users today
    public function count()
    {
        $data = $this->OnlineUser_model->get_online_users();
        echo ($data['user_count'] ? $data['user_count'] : 0). " คน";
    }


    public function test()
    {
        echo $this->view("online_user_test", [], true);
    }
}
