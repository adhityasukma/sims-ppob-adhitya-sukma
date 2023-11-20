<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;
use App\Controllers\Home;
/**
 * @var RouteCollection $routes
 */
//$routes->get('/', [Home::class,'index'],['filter' => 'auth']);
$routes->get('/', 'Auth::index');
$routes->get('/registration', 'Auth::registration');
$routes->get('/dashboard', 'Home::index',['filter' => 'auth']);
$routes->post('/registration', 'Auth::registration');
$routes->post('/login', 'Auth::check_login');
$routes->get('/logout', 'Auth::logout');

/**Service**/
$routes->get('/services/(:segment)', 'ServiceController::detail/$1',['filter' => 'auth']);

/** topup */
$routes->get('/topup', 'Home::topup',['filter' => 'auth']);
$routes->get('/topup_content/(:segment)', 'Home::topup_modal_view/$1');
$routes->post('/topup', 'Home::topup_saldo');

/** transaction service */
$routes->get('/ts_content/(:segment)/(:segment)', 'Home::ts_modal_view/$1/$2');
$routes->post('/transaction', 'Home::transaction');

/** history transaction */
$routes->get('/transaction', 'Home::transaction_history',['filter' => 'auth']);
$routes->get('/history/(:segment)', 'Home::history/$1');

/** Profile */
$routes->get('/profile', 'Home::profile_view',['filter' => 'auth']);
$routes->get('/profile/get_data', 'Home::profile_get');
$routes->post('/profile/image', 'Home::profile_image');
$routes->post('/profile/update', 'Home::profile_update');
