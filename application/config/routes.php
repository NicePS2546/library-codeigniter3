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
$route['test/upload'] = 'debug/test_upload_page';
$route['debug/test/upload/submit'] = 'debug/test_upload';

/*-------------------*/

// Room Music
$route['music'] = 'music/index';
$route['music/get/user'] = 'music/get_user_sso';
$route['music/reserv/(:num)'] = 'music/reserv_page/$1';
$route['music/check/(:num)'] = 'music/checkReserv/$1';
//reservation-sys
$route['music/reserv/submit'] = 'music/reserv';
$route['music/time/(:num)'] = 'music/get_availible_slots/$1';
$route['music/time/test'] = 'music/test';
/*-------------------*/

// Room Video
$route['vdo'] = 'vdo/index';
$route['vdo/service/(:num)'] = 'vdo/service_page/$1';
$route['vdo/reserv/(:num)/(:num)'] = 'vdo/reserv_page/$1/$2';
$route['vdo/seat'] = 'vdo/testLayout';
$route['vdo/time/(:num)'] = 'vdo/get_availible_slots/$1';
$route['vdo/check/(:num)'] = 'vdo/checkReserv/$1';
// Room Mini
$route['mini'] = 'mini/index';
$route['mini/reserv/(:num)'] = 'mini/reserv_page/$1';
$route['mini/check/(:num)'] = 'mini/checkReserv/$1';
$route['mini/join/(:num)'] = 'mini/join_page/$1';
$route['mini/join/submit'] = 'mini/join';
$route['mini/time/(:num)'] = 'mini/get_availible_slots/$1';
$route['mini/reserv/submit'] = 'mini/reserv';


// SSO
$route['sso/login'] = 'SSO/index';
$route['sso/logout'] = 'SSO/logout';
$route['user/history'] = 'SSO/user_history';

$route['history/delete/(:num)/(:num)'] = 'SSO/delete_reserv/$1/$2';


// Test
$route['test/sweet'] = 'test/testSweet';
$route['test/sweet2'] = 'Test/sweet2';

//Admin
$route['admin'] = 'Admin/index';
$route['admin/test'] = 'Admin/test';
$route['admin/check/reserv_data'] = 'Admin/reserv_data';

$route['admin/check/reserv/music'] = 'Admin/reserv_music';
$route['admin/check/reserv/vdo'] = 'Admin/reserv_vdo';
$route['admin/check/reserv/mini'] = 'Admin/reserv_mini';

$route['admin/expire/reserv/music/(:num)'] = 'Admin/expire_music/$1';
$route['admin/expire/reserv/vdo/(:num)'] = 'Admin/expire_vdo/$1';
$route['admin/expire/reserv/mini/(:num)'] = 'Admin/expire_mini/$1';

$route['admin/edit/reserv/music/(:num)'] = 'Admin/edit_reserv_music/$1';
$route['admin/edit/reserv/vdo/(:num)'] = 'Admin/edit_reserv_vdo/$1';
$route['admin/edit/reserv/mini/(:num)'] = 'Admin/edit_reserv_mini/$1';

$route['admin/update/music'] = 'Admin/update_music';
$route['admin/update/vdo'] = 'Admin/update_vdo';
$route['admin/update/mini'] = 'Admin/update_mini';


$route['admin/view/music'] = 'Admin/view_music';
$route['admin/view/vdo'] = 'Admin/view_vdo';
$route['admin/view/mini'] = 'Admin/view_mini';

$route['admin/data'] = 'Admin/admin_data';
$route['admin/add/submit'] = 'Admin/add_admin';
$route['admin/suspend/(:any)'] = 'Admin/suspend_admin/$1';
$route['admin/active/(:any)'] = 'Admin/active_admin/$1';

$route['admin/room_data/(:any)'] = 'Admin/room_data/$1';
$route['admin/room/view/(:any)'] = 'Admin/room_view_data/$1';
$route['admin/room/edit/(:any)/(:num)'] = 'Admin/edit_room_page/$1/$2';
$route['admin/room/edit/submit'] = 'Admin/edit_room_submit';
$route['admin/room/add/(:any)'] = 'Admin/add_room_page/$1';
$route['admin/room/add/submit/ok'] = 'Admin/add_room_submit';

$route['admin/update/deleteAll/reserv'] = 'Admin/delete_all';
$route['admin/update/delete/(:num)'] = 'Admin/delete_expire/$1';

$route['admin/time/setting'] = 'Admin/time_setting_page';
$route['admin/time/setting/submit'] = 'Admin/time_setting_submit';

//online user management
$route['online/append/user'] = 'OnlineUser/add';
$route['online/remove/user'] = 'OnlineUser/remove';
$route['online/count/user'] = 'OnlineUser/count';
$route['online/test'] = 'OnlineUser/test';




