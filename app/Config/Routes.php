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


// ajax routes
$routes->group('ajax', ['namespace' => '\App\Controllers'], function ($routes) {
    $routes->get('get-province', 'AjaxController::getProvinces');
    $routes->get('get-district/(:num)', 'AjaxController::getDistricts/$1');
    $routes->get('get-ward/(:num)', 'AjaxController::getWards/$1');
    $routes->get('get-shipping-fee', 'AjaxController::getShippingFee');
});
