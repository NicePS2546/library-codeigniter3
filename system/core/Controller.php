<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/userguide3/general/controllers.html
 */
class CI_Controller
{

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class) {
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	public function view($view, $data = [], $return = false)
	{
		return $this->load->view($view, $data, $return);
	}

	public function Render($view, $data)
	{
		$type = $this->get_type();
		$this->check_expire_music(); // check expire for music
		$this->check_expire_vdo(); // check expire for music
		$this->check_expire_mini(); // check expire for music

		// Layout structure
		$layout = [
			'title' => isset($data['title']) ? $data['title'] : "Default Title",  // Default title if not provided
			'navbar' => $this->view('Template/main/Navbar', ['page' => $data['page'], 'model'=> $data['model'],'type' => $type],true), // Return navbar as string
			'content' => $this->view($view, $data,true), // Return content as string
		];
		$current_url = $this->getCurrentUrl();
		$current_date = date("Y-m-d H:i");
		$page = [
			'music' => $current_url == base_url('index.php/music'),
			'vdo' => $current_url == base_url('index.php/vdo'),
			'mini' => $current_url == base_url('index.php/mini'),
			'index'=> $current_url == base_url()
		];
		
		$stage = $this->config->item('stage');
		if($stage == "Development"){
			$currentTime = $this->config->item('fixed_time');
		}else{
			$currentTime = date("H:i");
		}
		
		$day = getDay($current_date);
		if($day == "Saturday"){
			$layout['notice'] = $this->view('component/holiday', [], true);
		}else if ($currentTime < "08:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		} else if ($currentTime > "16:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		}
		// Merge the layout data with the original data
		$data['layout'] = $layout;

		return $this->view("Template/main/Layout", $data);
	}
	public function homeRender($view, $data)
	{
		$type = $this->get_type();
		$this->check_expire_music(); // check expire for music
		$this->check_expire_vdo(); // check expire for music
		$this->check_expire_mini(); // check expire for music

		// Layout structure
		$layout = [
			'title' => isset($data['title']) ? $data['title'] : "Default Title",  // Default title if not provided
			'header' => $this->view('Template/home/header',[],true), // Return content as string
			'navbar' => $this->view('Template/main/Navbar', ['page' => $data['page'], 'model'=> $data['model'],'type' => $type],true), // Return navbar as string
			'content' => $this->view($view, $data,true), // Return content as string
			'footer' => $this->view('Template/home/footer',[],true), // Return content as string
			
		];
		$current_url = $this->getCurrentUrl();
		$current_date = date("Y-m-d H:i");
		$page = [
			'music' => $current_url == base_url('index.php/music'),
			'vdo' => $current_url == base_url('index.php/vdo'),
			'mini' => $current_url == base_url('index.php/mini'),
			'index'=> $current_url == base_url()
		];
		
		$stage = $this->config->item('stage');
		if($stage == "Development"){
			$currentTime = $this->config->item('fixed_time');
		}else{
			$currentTime = date("H:i");
		}
		
		$day = getDay($current_date);
		if($day == "Saturday"){
			$layout['notice'] = $this->view('component/holiday', [], true);
		}else if ($currentTime < "08:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		} else if ($currentTime > "16:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		}
		// Merge the layout data with the original data
		$data['layout'] = $layout;

		return $this->view("Template/home/layout", $data);
	}
	public function check_admin(){
		$check_admin = $this->session->has_userdata('admin_data');
		
		return $check_admin;
	}
	public function AdminRender($view, $data)
	{
		$type = $this->get_type();
		$this->check_expire_music(); // check expire for music
		$this->check_expire_vdo(); // check expire for music
		$this->check_expire_mini(); // check expire for music
		
		if(!$this->check_admin()){
			$this->session->set_flashdata('error', "คุณไม่มีสิทธิ์เข้าถึง");
			redirect('/');
			exit();
		}

		// Layout structure
		$layout = [
			  // Default title if not provided
			'header' => $this->view('Template/admin/Header', ['title'=>$data['title']],true), // Return navbar as string
			'navbar' => $this->view('Template/admin/Navbar', ['page' => $data['page'], 'model'=> $data['model'],'type' => $type],true), // Return navbar as string
			'sidebar' => $this->view('Template/admin/Sidebar', ['title'=>$data['title']],true), // Return content as string,
			'content' => $this->view($view, $data,true), // Return content as string,
			'footer'=>$this->view('Template/admin/Footer',[],true)
		];

		$current_url = $this->getCurrentUrl();
		// $current_date = date("Y-m-d");

		
		
		$stage = $this->config->item('stage');
		if($stage == "Development"){
			$currentTime = $this->config->item('fixed_time');
		}else{
			$currentTime = date("H:i");
		}
		
		// $day = getDay($current_date);
		// if($day == "Saturday"){
		// 	$layout['notice'] = $this->view('component/holiday', [], true);
		// }else if ($currentTime < "08:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
		// 	$layout['notice'] = $this->view('component/not_in_time', [], true);
		// } else if ($currentTime > "16:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
		// 	$layout['notice'] = $this->view('component/not_in_time', [], true);
		// }
		// Merge the layout data with the original data
		$data['layout'] = $layout;

		return $this->view("Template/Admin/Layout", $data);
	}


	public function TestRender($view, $data)
	{
		$type = $this->get_type();

		// Layout structure
		$layout = [
			'title' => isset($data['title']) ? $data['title'] : "Default Title",  // Default title if not provided
			'navbar' => $this->view('Template/test/Navbar', ['page' => $data['page'], 'type' => $type],true), // Return navbar as string
			'content' => $this->view($view, $data,true), // Return content as string
		];

		// Merge the layout data with the original data
		$data['layout'] = $layout;

		return $this->view("Template/test/Layout", $data);
	}
	

	public function get_type()
	{
		$key = 't_id';
		$this->load->model('NameModel');
		$typeModel = $this->NameModel;

		$vdo = $typeModel->get_where($key, 2);
		$music = $typeModel->get_where($key, 1);
		$mini = $typeModel->get_where($key, 3);

		$data = [
			'vdo' => $vdo ? $vdo->type : null,
			'music' => $music ? $music->type : null,
			'mini' => $mini ? $mini->type : null,
		];



		return $data;
	}

	public function upload_image($type = 'vdo', $r_number = 1, $name)
{
    $upload_path = FCPATH . "public/assets/img/room_img/$type/";
    $file_ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    $file_name = $r_number . "." . $file_ext;
    $full_path = $upload_path . $file_name;

    // Delete old file (if exists)
    foreach (glob($upload_path . $r_number . ".*") as $existing_file) {
        unlink($existing_file);
    }

    // Move file manually
    if (move_uploaded_file($_FILES[$name]['tmp_name'], $full_path)) {
        return ['status' => true, 'img_name' => $type . '/' . $file_name];
    } else {
        return ['status' => false, 'error' => 'Failed to move uploaded file.'];
    }
}
	
// 	public function upload_image($type = 'vdo', $r_number = 1, $name)
// {
//     // Log file details
//     log_message('debug', print_r($_FILES, true));

//     if (empty($_FILES[$name]['name'])) {
//         return ['status' => false, 'error' => 'No file selected.'];
//     }

//     $upload_path = FCPATH . "public/assets/img/room_img/$type/";
//     if (!is_dir($upload_path)) {
//         if (!mkdir($upload_path, 0777, true)) {
//             die("Failed to create directory: " . $upload_path);
//         }
//     }

//     $resolved_path = realpath($upload_path);
//     if ($resolved_path === false) {
//         die("Resolved path is invalid.");
//     }

//     $file_ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
//     $file_name = $r_number . "." . $file_ext;
//     $full_path = $resolved_path . DIRECTORY_SEPARATOR . $file_name;

//     // Delete old files safely
//     foreach (glob($resolved_path . DIRECTORY_SEPARATOR . $r_number . ".*") as $existing_file) {
//         if (file_exists($existing_file)) {
//             unlink($existing_file);
//         }
//     }

//     // Upload Config
//     $config['upload_path']   = $resolved_path;
//     $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|webp|tiff|svg|ico';
//     $config['max_size']      = 2048;
//     $config['file_name']     = $file_name;
//     $config['overwrite']     = true;

//     $this->load->library('upload', $config);
//     $this->upload->initialize($config);

//     if ($this->upload->do_upload($name)) {
//         $data = $this->upload->data();
//         return ['status' => true, 'data' => $data, 'img_name' => "$type/$file_name"];
//     } else {
//         log_message('error', "Upload failed: " . $this->upload->display_errors());
//         return ['status' => false, 'error' => $this->upload->display_errors()];
//     }
// }
// 	public function upload_image_service($service_number = 1, $name)
// {
//     // Check if a file is selected
//     if (empty($_FILES[$name]['name'])) {
//         return ['status' => false, 'error' => 'You did not select a file to upload.'];
//     }

//     $upload_path = FCPATH . "public/assets/img/service_img/";

//     if (!is_dir($upload_path)) {
//         if (!mkdir($upload_path, 0777, true)) {
//             die("Failed to create directory: " . $upload_path);
//         }
//     }

//     $resolved_path = realpath($upload_path);
//     if ($resolved_path === false) {
//         die("Resolved path is invalid.");
//     }

//     $file_ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
//     $file_name = $service_number . "." . $file_ext;
//     $full_path = $resolved_path . DIRECTORY_SEPARATOR . $file_name;

//     // Delete old file if exists
//     foreach (glob($resolved_path . DIRECTORY_SEPARATOR . $service_number . ".*") as $existing_file) {
//         unlink($existing_file);
//     }

//     // Set upload configuration
//     $config['upload_path']   = $resolved_path;
//     $config['allowed_types'] = 'jpg|jpeg|png|gif';
//     $config['max_size']      = 2048;
//     $config['file_name']     = $file_name;
//     $config['overwrite']     = true; // Overwrite the old file

//     $this->load->library('upload', $config);
//     $this->upload->initialize($config);

//     if ($this->upload->do_upload($name)) {
//         $data = $this->upload->data();
//         return ['status' => true, 'data' => $data,'img_name'=>$file_name];
//     } else {
//         $error = $this->upload->display_errors();
//         return ['status' => false, 'error' => $error];
//     }
// }
	public function get_type_byId($id)
	{
		$key = 't_id';
		$this->load->model('NameModel');
		$typeModel = $this->NameModel;

		$data = $typeModel->get_where_array($key, $id);

		return $data['type'];
	}

	public function json_output($data){
		return $this->output
            ->set_content_type('application/json')
            ->set_output($data);
	}

	public function check_expire_music(){
		$this->load->model('reservation/MusicModel');
		$model = $this->MusicModel;
		$currentDate = date("Y-m-d");
		$rows = $model->get_past_reservations($currentDate);
		$model->expire_reserv($rows);
		
		return $rows;
	}
	public function check_expire_mini(){
		$this->load->model('reservation/MiniModel');
		$model = $this->MiniModel;
		$currentDate = date("Y-m-d");
		$rows = $model->get_past_reservations($currentDate);
		$model->expire_reserv($rows);
		
		return $rows;
	}
	public function check_expire_vdo(){
		$this->load->model('reservation/VdoModel');
		$model = $this->VdoModel;
		$currentDate = date("Y-m-d");
		$rows = $model->get_past_reservations($currentDate);
		$model->expire_reserv($rows);
		
		return $rows;
	}

	public function sweet($sweet,$title = "submit",$page = "*"){
		return $this->Render('sweet', [
			'sweet'=>$sweet,
            'title' => $title,
            'page' => $page,
        ]);
	}
	public function getCurrentUrl()
{
    // Check if the connection is secure (https)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    // Get the hostname
    $host = $_SERVER['HTTP_HOST'];

    // Get the request URI
    $uri = $_SERVER['REQUEST_URI'];

    // Combine to create the full URL
    $currentUrl = $protocol . $host . $uri;

    return $currentUrl;
}

public function get_all_time($s_id){
	$this->load->model('Time_Setting_Model');
	$time_setting_Model = $this->Time_Setting_Model;
	$time_data = $time_setting_Model->getTimeByS_Id($s_id);
	return generateTimeSlots($time_data['start_time'],$time_data['end_time'],$time_data['interval_hours']);
	 
}
public function post($post){
	return $this->input->post($post);
}
public function Model($path,$name,$usePath){
	if($usePath){
		$this->load->model("$path/$name");
	}else{
		$this->load->model($name);
	}
	
	return $this->$name;
}
public function get_user_sso_by_id($id)
{
	// $this->db->where('u_stuid',$id);
	// $this->db->or_where('u_idcard',$id);  
	// $query = $this->db->get('tbl_user');
	// return $query->row();



	$account = addslashes(stripslashes(htmlspecialchars(trim($id))));

	$ldapconf["host"] = "ldap://202.29.9.109";
	$ldapconf["port"] = NULL;
	$ldapconf["basedn"] = "dc=npru,dc=ac,dc=th";
	$ldapconf["LDAP_OPT_PROTOCOL_VERSION"] = 3;

	$ds = ldap_connect($ldapconf["host"]);
	if (!$ds) {
		echo "Could not connect to LDAP Server.";
		exit();
	}
	$ls = ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, $ldapconf["LDAP_OPT_PROTOCOL_VERSION"]);
	if (!$ls) {
		echo "Failed to set protocol version.";
		ldap_close($ds);
		exit();
	}
	// 10001 = อาจารย์
// 10002 = เจ้าหน้าที่
// 10003 = นักศึกษา
// 10005 = หน่อยงาน
	$query = "( & ( |(uid=" . $account . ")(uidnumber=" . $account . ")(gecos=" . $account . "))(accountStatus=TRUE)( | (gidNumber=10001)(gidNumber=10002)(gidNumber=10003)))";
	$sr = ldap_search($ds, $ldapconf["basedn"], $query);
	$info = ldap_get_entries($ds, $sr);
	//  print "<pre>";
	// print_r($info);
	//  print "</pre>";

	if ($info['count'] >= 1) {
		return $info;
	} else {
		return false;
	}
}
public function get_sso_name($ids)
{
    // Ensure $ids is an array
    if (!is_array($ids)) {
        $ids = [$ids];
    }

    // Create a query filter to search for all the IDs at once
    $accountFilter = [];
    foreach ($ids as $id) {
        $accountFilter[] = "( |(uid=" . addslashes(stripslashes(htmlspecialchars(trim($id)))) . ")(uidnumber=" . addslashes(stripslashes(htmlspecialchars(trim($id)))) . ")(gecos=" . addslashes(stripslashes(htmlspecialchars(trim($id)))) . "))";
    }
    $accountQuery = implode(' ', $accountFilter);

    // LDAP configuration
    $ldapconf["host"] = "ldap://202.29.9.109";
    $ldapconf["port"] = NULL;
    $ldapconf["basedn"] = "dc=npru,dc=ac,dc=th";
    $ldapconf["LDAP_OPT_PROTOCOL_VERSION"] = 3;

    // Connect to LDAP
    $ds = ldap_connect($ldapconf["host"]);
    if (!$ds) {
        echo "Could not connect to LDAP Server.";
        exit();
    }

    // Set the LDAP protocol version
    $ls = ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, $ldapconf["LDAP_OPT_PROTOCOL_VERSION"]);
    if (!$ls) {
        echo "Failed to set protocol version.";
        ldap_close($ds);
        exit();
    }

    // Construct the LDAP query
    $query = "( & ( |$accountQuery)(accountStatus=TRUE)( | (gidNumber=10001)(gidNumber=10002)(gidNumber=10003)))";
    $sr = ldap_search($ds, $ldapconf["basedn"], $query);
    $info = ldap_get_entries($ds, $sr);

    // Process the result
    $results = [];
    foreach ($info as $entry) {
        if (isset($entry['uid'][0])) {
            $results[$entry['uid'][0]] = isset($entry['cn'][0]) ? $entry['cn'][0] : 'Unknown';
        }
    }

    ldap_close($ds);

    return $results;
}






	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}



}
