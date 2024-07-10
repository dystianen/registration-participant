<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'UserController::loginView');
$routes->post('/login/submit', 'UserController::loginAuth');
$routes->get('/register', 'UserController::registerView');
$routes->post('/register/submit', 'UserController::registerAuth');
$routes->get('/riwayat-hidup', 'RiwayatHidupController::index');
$routes->get('/waiting', 'UserController::waiting');

// PESERTA
$routes->group('/peserta', function ($routes) {
  $routes->get('', 'RiwayatHidupController::listRiwayatHidupView');
  $routes->post('create', 'RiwayatHidupController::create');
  $routes->get('edit', 'RiwayatHidupController::editView');
  $routes->post('edit/(:num)', 'RiwayatHidupController::edit/$1');
  $routes->post('approve/(:num)', 'RiwayatHidupController::approve/$1');
  $routes->post('delete/(:num)', 'RiwayatHidupController::delete/$1');
});

// Admin
$routes->group('/admin', function ($routes) {
  $routes->get('', 'UserController::index');
});
