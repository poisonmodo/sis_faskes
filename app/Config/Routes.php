<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('ajax', function ($routes) {
	$routes->add('checklist/mhs/count', 'AjaxController::get_mhs_checklist_count');
	$routes->add('checklist/del', 'AjaxController::delete_checklist');
	$routes->add('user/del', 'AjaxController::delete_user');
	$routes->add('payment/del', 'AjaxController::delete_payment');
	$routes->add('skripsi/dosen/del', 'AjaxController::delete_skripsi_dosen');
	$routes->add('student/nim', 'AjaxController::get_student_by_nim');
	$routes->add('city/del', 'AjaxController::delete_city');
	$routes->add('student/detail', 'AjaxController::get_student_detail');
	$routes->add('student/list', 'AjaxController::get_student_list');
	$routes->add('yudisium/del', 'AjaxController::delete_yudisium');
	$routes->add('students/del', 'AjaxController::delete_student');
	$routes->add('province/del', 'AjaxController::delete_province');
});

$routes->group('export', function ($routes) {
	$routes->add('xls/students', 'ExportController::get_students');
	$routes->add('xls/ijazah', 'ExportController::get_student_ijazah');
});

$routes->group('management', function ($routes) {
	$routes->add('user', 'UsersController::get_user_list');
	$routes->add('user/edit/(:num)', 'UsersController::edit_user/$1');
	$routes->add('user/add', 'UsersController::add_user');

});

$routes->group('baak', function ($routes) {
	$routes->add('ijazah/edit/(:any)/(:num)', 'YudisiumController::edit_ijazah/$1/$2');
	$routes->add('ijazah/add/(:any)', 'YudisiumController::add_ijazah/$1');
	$routes->add('ijazah/(:any)', 'YudisiumController::get_ijazah/$1');
	$routes->add('checklist/edit/(:num)/(:num)', 'SkripsiController::edit_checklist/$1/$2');
	$routes->add('checklist/add/(:num)', 'SkripsiController::add_checklist/$1');
	$routes->add('checklist/(:num)', 'SkripsiController::get_checklist/$1');
	$routes->add('payment/edit/(:num)/(:num)', 'PaymentController::edit_payment/$1/$2');
	$routes->add('payment/add/(:num)', 'PaymentController::add_payment/$1');
	$routes->add('payment/(:num)', 'PaymentController::get_payment/$1');
	$routes->add('yudisium/edit/(:any)/(:num)', 'YudisiumController::edit_yudisium/$1/$2');
	$routes->add('yudisium/add/(:any)', 'YudisiumController::add_yudisium/$1');
	$routes->add('students/(:any)', 'YudisiumController::get_students/$1');
	$routes->add('yudisium/(:any)', 'YudisiumController::get_yudisium/$1');
});

$routes->group('master', function ($routes) {
	$routes->add('city/edit/(:num)', 'MasterController::edit_city/$1');
	$routes->add('city/add', 'MasterController::add_city');
	$routes->add('city', 'MasterController::get_city');
	$routes->add('province/edit/(:num)', 'MasterController::edit_province/$1');
	$routes->add('province/add', 'MasterController::add_province');
	$routes->add('province', 'MasterController::get_province');
	$routes->add('vaksin', 'MasterController::get_vaksin');
	$routes->add('vaksin/edit/(:num)', 'MasterController::edit_vaksin/$1');
	$routes->add('vaksin/add', 'MasterController::add_vaksin');
	
});

$routes->add('changepassword', 'UsersController::chpass');
$routes->add('login', 'UsersController::login');
$routes->add('logout', 'UsersController::logout');
$routes->add('/home', 'HomeController::home');
$routes->add('/', 'HomeController::home');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
