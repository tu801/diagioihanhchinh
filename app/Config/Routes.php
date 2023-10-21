<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/export-provice', 'Home::exportProvince');
$routes->get('/export-districts', 'Home::exportDistrict');
$routes->get('/export-wards', 'Home::exportWard');

$routes->get('/provinces', 'ProvinceControllser::index');
$routes->get('/districts', 'DistrictController::index');
$routes->get('/wards', 'WardController::index');
