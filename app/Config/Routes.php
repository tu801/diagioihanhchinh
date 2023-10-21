<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/provinces', 'ProvinceControllser::index');
$routes->get('/districts', 'DistrictController::index');
$routes->get('/wards', 'WardController::index');
