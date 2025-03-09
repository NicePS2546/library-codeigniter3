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
        $state = "Deployment";
        if ($state === "Deployment") {
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
                return;
            }

            // Get LDAP entries
            $info = ldap_get_entries($ds, $sr);


            if ($info['count'] == 1) {
                if (!ldap_bind($ds, $info[0]['dn'], $password)) {
                    $this->session->set_flashdata('error', 'รหัสผู้ใช้งานหรือรหัสผ่านผิด');
                    ldap_close($ds);
                    redirect('/');
                } else {



                    // Extract user information
                    $fullname = isset($info[0]['cn'][0]) ? $info[0]['cn'][0] : 'Unknown';
                    $u_id = isset($info[0]['uid'][0]) ? $info[0]['uid'][0] : 'Unknown';
                    $admin = $this->check_sso_admin($u_id);

                    $friend_ids = [654230003, 654230044, 654230053, 654230041, 654230029, 654230037]; // Replace with actual user IDs

                    $is_friend = in_array($u_id, $friend_ids);

                    list($firstName, $lastName) = explode(" ", $fullname);

                    // Set session data
                    $this->session->set_userdata([
                        'userData' => [
                            'fullname' => $fullname,
                            'uid' => $u_id,

                        ]
                    ]);

                    if ($is_friend) {
                        $this->session->set_userdata([
                            'is_friend' => $is_friend
                        ]);
                    }

                    // print "<pre>";
                    // print_r($info);
                    // print "</pre>";

                    // Redirect to the index method or another page
                    if ($admin) {
                        $admin_id = $admin['user_id'];
                        $admin_fname = $firstName;
                        $admin_lname = $lastName;

                        $this->session->set_userdata([
                            'admin_data' => [
                                'uid' => $admin_id,
                                'fname' => $admin_fname,
                                'lname' => $admin_lname
                            ]
                        ]);
                        $this->session->set_flashdata('success', "ยินดีต้อนรับผู้ดูแล $admin_fname $admin_lname");
                    } else {
                        $this->session->set_flashdata('success', "ยินดีต้อนรับ $fullname");
                    }

                    ldap_close($ds);
                    redirect(base_url());
                }
            }
        } else {
            $this->session->set_userdata([
                'userData' => [
                    'fullname' => "Development",
                    'uid' => "654230015",
                ]
            ]);

            $this->session->set_userdata([
                'admin_data' => [
                    'uid' => "654230015",
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
        $this->session->set_flashdata('success', "ออกจากระบบสำเร็จ");
        // Redirect to the login or home page
        redirect('/'); // Replace 'login' with your desired route
    }
    protected function check_sso_admin($uid)
    {
        $this->load->model('AdminModel');
        $model = $this->AdminModel;

        $row = $model->get_admin($uid);
        return $row;
    }


    public function user_history()
    {
        $user_data = $this->session->userdata['userData'];
        $music = $this->Model('reservation', 'MusicModel', true);
        $vdo = $this->Model('reservation', 'VdoModel', true);
        $mini = $this->Model('reservation', 'MiniModel', true);
        $type = $this->Model('', 'NameModel', false);

        $music_history_old = $music->get_all_by_reserv_id($user_data['uid']);
        $vdo_history_old = $vdo->get_all_by_reserv_id($user_data['uid']);
        $mini_history_old = $mini->get_all_by_reserv_id($user_data['uid']);

        $music_history_current = $music->get_all_by_reserv_id($user_data['uid'], 'actived');
        $vdo_history_current = $vdo->get_all_by_reserv_id($user_data['uid'], 'actived');
        $mini_history_current = $mini->get_all_by_reserv_id($user_data['uid'], 'actived');

        $old_history = array_merge($music_history_old, $vdo_history_old, $mini_history_old);

        $current_history = array_merge($music_history_current, $vdo_history_current, $mini_history_current);




        return $this->Render('history/page', [
            'old_history' => $old_history,
            'current_history' => $current_history,
            'title' => 'ประวัติการจอง',
            'page' => 'home',
            'typeModel' => $type,
            'find_sso_data' => function ($uid) {
                return $this->get_sso_name($uid);
            }
        ]);



    }

    public function delete_reserv($type_id,$reserv_id){
        $total_pp = $this->post('total_pp');
        switch ($type_id) {
            case 1:
                $name = 'MusicModel';
                break;
            case 2:
                $name = 'VdoModel';
                break;
            case 3:
                $name = 'MiniModel';
                break;
            default:
            $name = 'MusicModel';
            }
        $model = $this->Model('reservation',$name,true);
        $statistic = $this->Model('statistic','StatisticModel',true);
        
        $result = transaction($this->db,$statistic->update_on_cancel($type_id,$total_pp),$model->delete_by_id($reserv_id));
        if ($result) {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "ยกเลิกการจองห้องสำเร็จ!",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "' . base_url('index.php/user/history') .'"; 
                });
            }, 1000);
            </script>';
        } else {
            $sweet = '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "ยกเลิกการจองห้องไม่สำเร็จ",
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "'  . base_url('index.php/user/history') .'"; 
                });
            }, 1000);
            </script>';
        }
        return $this->sweet($sweet, 'Cancel Reservation', '');
    }
}

