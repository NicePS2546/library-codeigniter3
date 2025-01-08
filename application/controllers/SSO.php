<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
            redirect('SSO');
        }

        // Set LDAP protocol version
        if (!ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, $ldapconf["LDAP_OPT_PROTOCOL_VERSION"])) {
            ldap_close($ds);
            $this->session->set_flashdata('error', 'Failed to set LDAP protocol version.');
            redirect('SSO');
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
            redirect('SSO');
        }

        // Get LDAP entries
        $info = ldap_get_entries($ds, $sr);
        ldap_close($ds);

        if ($info['count'] === 0) {
            $this->session->set_flashdata('error', 'No matching user found.');
            redirect('SSO');
        }

        // Extract user information
        $fullname = isset($info[0]['cn'][0]) ? $info[0]['cn'][0] : 'Unknown';
        $student_id = isset($info[0]['uid'][0]) ? $info[0]['uid'][0] : 'Unknown';

        // Set session data
        $this->session->set_userdata(['userData' => [
            'fullname' => $fullname,
            'student_id' => $student_id,
        ]]);

        
        // Redirect to the index method or another page
        $this->session->set_flashdata('success', 'Login successful!');
        redirect(base_url());

    }
}
