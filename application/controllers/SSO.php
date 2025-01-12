<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SSO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load session library if not already autoloaded
        $this->load->library('session');

    }

    public function index()
    {
        // Retrieve POST data
        $state = "development";
        if ($state === "deployment") {
        $st_id = $this->input->post('st_id');
        $password = $this->input->post('password');

        // Sanitize inputs
        $account = htmlspecialchars(trim($st_id), ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars(trim($password), ENT_QUOTES, 'UTF-8');

        // LDAP configuration
        $ldapconf = [
            'host' => "ldap://202.29.9.109",
            'port' => null,
            'basedn' => "dc=npru,dc=ac,dc=th",
            "LDAP_OPT_PROTOCOL_VERSION" => 3,
        ];

        // Connect to LDAP
        $ds = ldap_connect($ldapconf['host']);
        if (!$ds) {
            $this->session->set_flashdata('error', 'Could not connect to LDAP Server.');
            redirect('/');
        }

        // Set LDAP protocol version
        if (!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, $ldapconf["LDAP_OPT_PROTOCOL_VERSION"])) {
            ldap_close($ds);
            $this->session->set_flashdata('error', 'Failed to set LDAP protocol version.');
            redirect('/');
        }

        // LDAP query
        $query = sprintf(
            "(&(|(uid=%s)(gecos=%s))(accountStatus=TRUE)(|(gidNumber=10001)(gidNumber=10002)(gidNumber=10003)))",
            ldap_escape($account, '', LDAP_ESCAPE_FILTER),
            ldap_escape($account, '', LDAP_ESCAPE_FILTER)
        );

        $sr = ldap_search($ds, $ldapconf['basedn'], $query);
        if (!$sr) {
            ldap_close($ds);
            $this->session->set_flashdata('error', 'LDAP search failed.');
            redirect('/');
        }

        // Get LDAP entries
        $info = ldap_get_entries($ds, $sr);
        ldap_close($ds);

        if ($info['count'] === 0) {
            $this->session->set_flashdata('error', 'รหัสผู้ใช้งานหรือรหัสผ่านผิด');
            redirect('/');
        }

        // Extract user information
        $fullname = isset($info[0]['cn'][0]) ? $info[0]['cn'][0] : 'Unknown';
        $u_id = isset($info[0]['uid'][0]) ? $info[0]['uid'][0] : 'Unknown';
        $admin = $this->check_admin($u_id);
        list($firstName, $lastName) = explode(" ", $fullname);

        if ($admin) {
            $admin_id = $admin['user_id'];
            $admin_fname = $firstName;
            $admin_lname = $lastName;
            // print_r($admin);
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
        }
    
      

            // Set session data
            $this->session->set_userdata([
                'userData' => [
                    'fullname' => $fullname,
                    'student_id' => $u_id,
                ]
            ]);

            // print "<pre>";
            // print_r($info);
            // print "</pre>";

            // Redirect to the index method or another page
            if ($admin) {
                $this->session->set_userdata([
                    'admin_data' => [
                        'user_id' => $admin_id,
                        'fname' => $admin_fname,
                        'lname' => $admin_lname
                    ]
                ]);
                $this->session->set_flashdata('success', "ยินดีต้อนรับผู้ดูแล $admin_fname $admin_lname");
            } else {
                $this->session->set_flashdata('success', 'ล็อกอินสำเร็จ');
            }


            redirect(base_url());

        } else {
            $this->session->set_userdata([
                'userData' => [
                    'fullname' => "Development",
                    'student_id' => "654230015",
                ]
            ]);

            $this->session->set_userdata([
                'admin_data' => [
                    'user_id' => "654230015",
                    'fname' => "Nice",
                    'lname' => "Pasit"
                ]
            ]);
            $this->session->set_flashdata('success', "ยินดีต้อนรับผู้พัฒนา Nice Pasit");
            redirect(base_url());
        }


    }

    public function logout()
    {
        // Clear all session data
        $this->session->sess_destroy();

        // Redirect to the login or home page
        redirect('/'); // Replace 'login' with your desired route
    }
    protected function check_admin($uid)
    {
        $this->load->model('AdminModel');
        $model = $this->AdminModel;

        $row = $model->get_admin($uid);
        return $row;
    }


}
