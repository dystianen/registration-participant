<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PesertaController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login/auth', 'LoginController::loginAuth');

// PESERTA
$routes->group('/peserta', function ($routes) {
  $routes->get('', 'PesertaController::listPesertaView');
  $routes->post('create', 'PesertaController::create');
  $routes->get('edit', 'PesertaController::editView');
  $routes->post('edit/(:num)', 'PesertaController::edit/$1');
  $routes->post('approve/(:num)', 'PesertaController::approve/$1');
  $routes->post('delete/(:num)', 'PesertaController::delete/$1');
});

// Admin
$routes->group('/admin', function ($routes) {
  $routes->get('', 'AdminController::index');
});
