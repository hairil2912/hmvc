<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}
// $routes->get('/', 'Login::index');
$routes->setDefaultController('Login');
$routes->match(['get', 'post'],'/', 'App\Modules\Login\Controllers\Login::index');
// $routes->post('/', 'App\Modules\Login\Controllers\Login::index');
			
			

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
 // $routes->add('{locale}/(:segment)/(:any)', 'Rerouter::reroute/$1/$2');
$uri = service('uri');
	$uri_segments = $uri->getSegments();
	if ($uri_segments) {
	helper('module');
	$module = get_module_name();

	// echo '<pre>'; print_r( $module ); die;
	// echo '<pre>'; print_r($module);

	// echo '<pre>'; print_r($module); die;
	// echo 'App\Modules\\' .$nama_module . '\Controllers'; die;
	// $routes->add('product/(:num)', 'App\Modules::productLookup');

	// $routes->add( str_replace('\\', '/', $nama_module), '\App\Modules\\' . $nama_module . '::index');

	// $routes->add( 'builtin/menu', '\App\Modules\Builtin\Menu\Controllers\Menu');
// echo $module['segments']; die;
	$routes->add( $module['segments'], '\App\Modules\\' .  $module['name'] . '\Controllers\\' . $module['class']  . '::' . $module['method']);

	}
// $routes->setDefaultNamespace('\App\Modules\\' .$nama_module . '\Controllers');
// $routes->setDefaultNamespace('\App\Modules\Builtin\Menu\Controllers');


$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/* $routes->get('/', 'Home::index');
$routes->setTranslateURIDashes(true);
 */
 
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
