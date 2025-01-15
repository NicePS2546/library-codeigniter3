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
		$this->check_expire();
		// Layout structure
		$layout = [
			'title' => isset($data['title']) ? $data['title'] : "Default Title",  // Default title if not provided
			'navbar' => $this->view('Template/main/Navbar', ['page' => $data['page'], 'model'=> $data['model'],'type' => $type],true), // Return navbar as string
			'content' => $this->view($view, $data,true), // Return content as string
		];
		$current_url = $this->getCurrentUrl();

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
		

		if ($currentTime < "09:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		} else if ($currentTime > "16:00" && ($page['index'] || $page['music'] || $page['vdo'] || $page['mini'])) {
			$layout['notice'] = $this->view('component/not_in_time', [], true);
		}
		// Merge the layout data with the original data
		$data['layout'] = $layout;

		return $this->view("Template/main/Layout", $data);
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
	public function json_output($data){
		return $this->output
            ->set_content_type('application/json')
            ->set_output($data);
	}

	public function check_expire(){
		$this->load->model('reservation/MusicModel');
		$model = $this->MusicModel;
		$currentDate = date("Y-m-d");
		$rows = $model->get_past_reservations($currentDate);
		$model->expire_reserv($rows);
		
		return $rows;
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
