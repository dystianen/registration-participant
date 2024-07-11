<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('/', function ($routes) {
  $routes->get('', 'UserController::registerView');
  $routes->post('register/submit', 'UserController::registerAuth');
  $routes->get('login', 'UserController::loginView');
  $routes->post('login/submit', 'UserController::loginAuth');
  $routes->get('riwayat-hidup', 'RiwayatHidupController::index');
  $routes->post('create-riwayat-create', 'RiwayatHidupController::create');
  $routes->get('waiting', 'UserController::waiting');
  $routes->post('logout', 'UserController::logout');
});

// PESERTA
$routes->group('/peserta', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'RiwayatHidupController::listRiwayatHidupView');
  $routes->get('edit', 'RiwayatHidupController::editView');
  $routes->post('edit/(:num)', 'RiwayatHidupController::edit/$1');
  $routes->post('approve/(:num)', 'RiwayatHidupController::approve/$1');
  $routes->post('delete/(:num)', 'RiwayatHidupController::delete/$1');
});

// Admin
$routes->group('/admin', function ($routes) {
  $routes->get('', 'UserController::loginView');
});
