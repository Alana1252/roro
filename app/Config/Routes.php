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
// Rute untuk halaman home
$routes->add('/', 'HomeController::index');
$routes->add('/home', 'HomeController::index');


$routes->addRedirect('/', 'HomeController::index');
$routes->get('/', 'News::index');
$routes->get('/home', 'News::index');


//generate tiket
$routes->get('generate', 'CronController::generateTiket');


//Cari Tiket
$routes->get('tiket/search', 'TiketController::search', ['as' => 'search']);
$routes->get('/tiket', 'TiketController::index');

//detail tiket saya
$routes->get('tiket/tiket-saya', 'PaymentController::showOrderInfo');
$routes->get('tiket/detail-tiket', 'PaymentController::showOrderDetails', ['as' => 'detail-pesanan']);
$routes->post('tiket/select-detail', 'PaymentController::detailPesanan', ['as' => 'select-pesanan']);

//Tambah tiket hasil pencarian
$routes->get('tambah/tiket', 'DataController::detailTiket', ['as' => 'detail-tiket']);
$routes->post('tambah-tiket', 'DataController::selectTicket', ['as' => 'select-ticket']);
$routes->post('tambah/update_payment', 'TambahController::updatePayment');
$routes->post('tambah/tambahPaymentResult', 'TambahController::tambahPaymentResult');

//Print tiket
$routes->get('/cari-orderid', 'TiketController::cariOrder');
$routes->add('/order/search', 'TiketController::searchTransaksi'); // Route untuk pencarian order_id (POST)
$routes->add('/order/print/(:any)', 'TiketController::view/$1'); // Route untuk halaman tampilan order_id

$routes->get('/admin', 'AdminController::user', ['filter' => 'role:admin']);
$routes->get('/admin/user', 'AdminController::user', ['filter' => 'role:admin']);
$routes->add('user/edit/(:segment)', 'AdminController::editUser/$1', ['filter' => 'role:admin']);
$routes->get('user/delete/(:num)', 'AdminController::deleteUser/$1');
$routes->get('/admin/tiket', 'AdminController::showTicket', ['filter' => 'role:admin']);
$routes->add('tiket/edit/(:segment)', 'AdminController::editTiket/$1', ['filter' => 'role:admin']);
$routes->get('tiket/delete/(:num)', 'AdminController::deleteTiket/$1', ['filter' => 'role:admin']);
$routes->get('tiket/delete/all', 'AdminController::deleteAllTiket', ['filter' => 'role:admin']);
$routes->get('tiket/generate', 'CronController::generateTiket', ['filter' => 'role:admin']);
$routes->get('export-tiket', 'AdminController::exportTiket', ['as' => 'exportTiket'], ['filter' => 'role:admin']);









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
