<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')){
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
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
//$routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->get('login/authenticate', 'Login::authenticate');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/report', 'Report::index');

// Role Management 
$routes->group('role', function($routes) {
	// // $routes->add('list', 'Role::index');
	// //$routes->add('add', 'Role::add');
	// // $routes->add('editrole/(:num)', 'Role::edit/$1');
	// // $routes->add('edit/(:num)', 'Role::addedit/$1');
	// // $routes->add('save',  'Role::save_role');
	// $routes->add('update',  'Role::update_role');
	
	// $routes->add('account_add/(:num)', 'Role::account_add/$1');
	// $routes->add('account_list/(:any)', 'Role::account_list/$1');
	// $routes->add('account_save',  'Role::save_account');

	// $routes->add('add', 'Role::addedit'); // role add page
	// $routes->add('edit/(:num)', 'Role::addedit/$1'); // role edit page
	// $routes->add('list', 'Role::list_roles'); // list roles
	// $routes->add('save_role',  'Role::save_role');
	// $routes->add('delete', 'Role::delete_role');  // delete role
	// $routes->add('access/(:num)','Role::show_role_access/$1');
	// $routes->add('save_access','Role::save_role_access');
	// $routes->add('list', 'Role::index');
	//$routes->add('add', 'Role::add');
	// $routes->add('editrole/(:num)', 'Role::edit/$1');
	// $routes->add('edit/(:num)', 'Role::addedit/$1');
	// $routes->add('save',  'Role::save_role');
	$routes->add('update',  'Role::update_role');
	$routes->add('delete/(:num)', 'Role::delete_role/$1'); 
	$routes->add('account_add/(:num)', 'Role::account_add/$1');
	$routes->add('account_list/(:any)', 'Role::account_list/$1');
	$routes->add('account_save',  'Role::save_account');
	$routes->add('add', 'Role::addedit'); // role add page
	$routes->add('edit/(:num)', 'Role::addedit/$1'); // role edit page
	$routes->add('view/(:num)', 'Role::view_role/$1'); // role edit page
	$routes->add('list', 'Role::list_roles'); // list roles
	$routes->add('save_role',  'Role::save_role');
	$routes->add('edit/access/(:num)','Role::show_role_access/$1');
	$routes->add('save_access','Role::save_role_access');
	$routes->post('delete_access','Role::delete_role_access');
	$routes->post('delete', 'Role::delete_role');  // delete role
	
});


// Customer Management 
$routes->group('customer', function($routes) {
	$routes->add('index', 'Customer::index');
	$routes->add('list', 'Customer::list');
	$routes->add('account', 'Customer::account');
	$routes->get('account/(:any)', 'Customer::account/$1');
	$routes->get('change_password/(:num)', 'Customer::change_password/$1');
	$routes->post('account_save', 'Customer::account_save');
	$routes->add('subscription', 'Customer::subscription');
	$routes->post('subscription_save', 'Customer::subscription_save');
	$routes->get('customer_sub/delete/(:num)/(:num)', 'Customer::sub_delete/$1');
	$routes->add('license', 'Customer::license');
	$routes->get('license/(:num)', 'Customer::license/$1');
	$routes->post('license_save', 'Customer::license_save');
	$routes->post('sms_save', 'Customer::sms_save');
	$routes->add('billing_details', 'Customer::billing_details');
	$routes->get('billing_details/(:num)', 'Customer::billing_details/$1');
	$routes->post('billing_save', 'Customer::billing_save');
	$routes->add('brand_logo', 'Customer::brand_logo');
	$routes->post('brand_save', 'Customer::brand_save');
	$routes->get('view/(:num)', 'Customer::view/$1');
	$routes->post('user_save', 'Customer::user_save');
	$routes->get('customer_sub/delete/(:num)/(:num)', 'Customer::sub_delete/$1');
	$routes->get('delete', 'Customer::delete');
	$routes->get('customer_user/delete/(:num)/(:num)', 'Customer::user_delete/$1');
	$routes->get('my_details', 'Customer::my_details');
	$routes->get('single_branch', 'Customer::single_branch');
	$routes->get('single_user', 'Customer::single_user');



});
// Subscription Management 
$routes->group('subscription', function($routes) {
	$routes->add('add', 'Subscription::addedit');
	$routes->get('edit/(:num)', 'Subscription::addedit/$1');
	$routes->get('view/(:num)', 'Subscription::view/$1');
	$routes->get('list', 'Subscription::list');
	$routes->post('save', 'Subscription::store');
	$routes->post('edit/save', 'Subscription::store');
	$routes->post('delete', 'Subscription::delete_sub');

});

$routes->group('report', function($routes) {
	$routes->add('view_details/(:num)', 'Report::view_details/$1');
	$routes->add('view_details/(:num)/(:num)', 'Report::view_details/$1/$2');
	$routes->get('get_customer', 'Report::get_customer');
	$routes->get('get_branch', 'Report::get_branch');
	$routes->add('download_csv/(:num)', 'Report::download_csv/$1');

});



$routes->get('subscription/list', 'Subscription::list');

// Rest api 
$routes->group('api', function($routes) {
	// $routes->get('brand_list', 'Api::index');
	
	$routes->post('login', 'Api::validateUser');
	$routes->post('role_access', 'Api::role_access');
	$routes->post("customer_list", "Api::customer_list");
	$routes->post("branch_list", "Api::branch_list");  
    $routes->post('userdata', 'Api::userDetails');

});

    $routes->post('generate_token', 'Api::generate_token');
	$routes->post('auth_user', 'Api::auth_user');


// $routes->post("/api/register", "Api::createUser");

// $routes->post("/api/login", "Api::validateUser");

// $routes->get("/api/userdata", "Api::show");

// $routes->post("/api/logout", "Api::logoutUser");


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
