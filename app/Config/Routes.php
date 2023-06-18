<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'HomeController::index'); // Route untuk halaman home
        $routes->add('/user', 'UserController::index'); // Route untuk halaman user

        $routes->addRedirect('/', 'HomeController::index');
        $routes->get('/', 'News::index');
        $routes->get('/home', 'News::index');




//Tiket Routes
$routes->get('tiket/search', 'TiketController::search');
$routes->get('/tiket', 'TiketController::index');
$routes->get('cron/generate-tiket', 'CronController::generateTiket');
$routes->add('/home', 'HomeController::index');

// $routes->group('/payment', ['namespace' => 'App\Controllers'], function ($routes) {
//     $routes->get('/', 'PaymentController::index');
//     $routes->post('handlePaymentResult', 'PaymentController::handlePaymentResult');
    

// });

$routes->get('payment', 'PaymentController::index');
$routes->post('payment/get-snap-token', 'PaymentController::getSnapToken');
$routes->post('payment/handle-payment-result', 'PaymentController::handlePaymentResult');



// ...






/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
