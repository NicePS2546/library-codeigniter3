<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function index()
    {


        return $this->Render('welcome_message', [
            'title' => 'test',
            'page' => 'home'
        ]);

    }
    public function sweet2()
    {
        return $this->Render('test_sweet', [
            'title' => 'test',
            'page' => 'home'
        ]);

    }
    public function testSweet()
    {

        echo "<script src='" . base_url('public/cdn/sweetalert.js') . "'></script>";
        echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "success",
            title: "ห้อง 2 ถูกจองแล้ว.",
            showConfirmButton: true
        }).then(() => {
            window.location.href = "' . base_url('debug') . '";
        });
    });
</script>';
        // return $this->Render('sweet',[
        // 	'title'=>'test',
        // 	'page'=>'test']);

    }


}
