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
// $routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/dashboard', 'Dashboard::index');

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
	$routes->add('list', 'Role::list_roles'); // list roles
	$routes->add('save_role',  'Role::save_role');
	$routes->add('access/(:num)','Role::show_role_access/$1');
	$routes->add('save_access','Role::save_role_access');
	$routes->add('delete', 'Role::delete_role');  // delete role
	
});


// Customer Management 
$routes->group('customer', function($routes) {
	$routes->add('index', 'customer::index');
	$routes->add('list', 'customer::list');
	$routes->add('account', 'customer::account');
	$routes->get('account/(:num)', 'customer::account/$1');
	$routes->post('account_save', 'customer::account_save');
	$routes->add('subscription', 'customer::subscription');
	$routes->post('subscription_save', 'customer::subscription_save');
	$routes->add('license', 'customer::license');
	$routes->get('license/(:num)', 'customer::license/$1');
	$routes->post('license_save', 'customer::license_save');
	$routes->add('billing_details', 'customer::billing_details');
	$routes->get('billing_details/(:num)', 'customer::billing_details/$1');
	$routes->post('billing_save', 'customer::billing_save');
	$routes->add('brand_logo', 'customer::brand_logo');
	$routes->post('brand_save', 'customer::brand_save');

});
// Subscription Management 
$routes->group('subscription', function($routes) {
	$routes->add('add', 'Subscription::addedit');
	$routes->get('edit/(:num)', 'Subscription::addedit/$1');
	$routes->get('view/(:num)', 'Subscription::view/$1');
	$routes->get('list', 'Subscription::list');
	$routes->post('save', 'Subscription::store');
	$routes->post('edit/save', 'Subscription::store');
	$routes->get('delete/(:num)', 'Subscription::delete/$1');

});

$routes->get('subscription/list', 'Subscription::list');

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
