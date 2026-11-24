<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
//$routes->get('/', 'Home::index');


$routes->get('/', 'AuthController::index');
$routes->post('login', 'AuthController::autenticar');
$routes->get('logout', 'AuthController::logout');

$routes->get('departamento/reportar', 'IncidenciaController::index');
$routes->post('departamento/guardar', 'IncidenciaController::guardar');
$routes->get('departamento/detalles/(:num)', 'IncidenciaController::detalles/$1');

$routes->get('admin/panel', 'AdminController::index');
$routes->get('admin/detalles/(:num)', 'AdminController::detalles/$1');
$routes->post('admin/actualizar/(:num)', 'AdminController::actualizar/$1');
$routes->post('admin/finalizar/(:num)', 'AdminController::finalizar/$1');
$routes->get('admin/historial', 'AdminController::historial');
$routes->get('departamento/historial', 'IncidenciaController::historial');
