<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
//$routes->get('/', 'Home::index');


$routes->get('/', 'AuthController::index');
$routes->post('login', 'AuthController::autenticar');
$routes->get('logout', 'AuthController::logout');


$routes->get('panel', 'ReparacionController::index');
$routes->get('reparaciones/crear', 'ReparacionController::crear');
$routes->post('reparaciones/guardar', 'ReparacionController::guardar');
$routes->get('reparaciones/detalles/(:num)', 'ReparacionController::detalles/$1');
$routes->get('reparaciones/editar/(:num)', 'ReparacionController::editar/$1');
$routes->post('reparaciones/actualizar/(:num)', 'ReparacionController::actualizar/$1');
$routes->post('reparaciones/finalizar/(:num)', 'ReparacionController::finalizar/$1');
$routes->get('reparaciones/historial', 'ReparacionController::historial');
