<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PesertaController::index');
$routes->post('/peserta/create', 'PesertaController::create');
