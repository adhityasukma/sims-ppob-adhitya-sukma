<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
//$routes->get('/', [Home::class,'index'],['filter' => 'auth']);
$routes->get('/', 'MembershipController::index');
$routes->get('/registration', 'MembershipController::registration');  //used
$routes->get('/dashboard', 'HomeController::index');  //used

$routes->get('/logout', 'MembershipController::logout');  //used
$routes->post('/set_session', 'MembershipController::set_session');  //used

/**Service**/
$routes->get('/services/(:segment)', 'ServiceController::detail_service/$1');  //used

/** topup */
$routes->get('/topup', 'TransactionController::topup');
//$routes->get('/topup_content/(:segment)', 'Home::topup_modal_view/$1');
//$routes->post('/topup', 'Home::topup_saldo');

/** transaction service */
//$routes->get('/ts_content/(:segment)/(:segment)', 'Home::ts_modal_view/$1/$2'); //used
$routes->get('/ts_content', 'ServiceController::ts_modal_view'); //used
//$routes->post('/transaction', 'Home::transaction');

/** history transaction */
$routes->get('/transaction', 'TransactionController::transaction_history');
//$routes->get('/history/(:segment)', 'Home::history/$1');

/** Profile */
$routes->get('/profile', 'MembershipController::profile_view');
//$routes->get('/profile/get_data', 'Home::profile_get');
//$routes->post('/profile/image', 'Home::profile_image');
//$routes->post('/profile/update', 'Home::profile_update');
