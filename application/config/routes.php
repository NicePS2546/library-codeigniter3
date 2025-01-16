<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Debug Zone
$route['admin/debug'] = 'debug/index';
$route['debug/insert'] = 'debug/insert_data';
$route['debug/room'] = 'debug/fetchAllRooms';
$route['debug/delete'] = 'debug/delete';
$route['debug/status'] = 'debug/status_modify';
$route['debug/time'] = 'debug/timeTest';
$route['debug/sweet'] = 'debug/testSweetAlert';

/*-------------------*/

// Room Music
$route['music'] = 'music/index';
$route['music/get/user'] = 'music/get_user_sso';
$route['music/reserv/(:num)'] = 'music/reserv_page/$1';
//reservation-sys
$route['music/reserv/submit'] = 'music/reserv';
$route['music/time/(:num)'] = 'music/get_availible_slots/$1';
$route['music/time/test'] = 'music/test';
/*-------------------*/

// Room Video
$route['vdo'] = 'vdo/index';
$route['vdo/seat'] = 'vdo/testLayout';

// Room Mini
$route['mini'] = 'mini/index';

// SSO
$route['sso/login'] = 'sso/index';
$route['sso/logout'] = 'sso/logout';