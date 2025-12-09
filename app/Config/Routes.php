<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Login::index');

$routes->get('/users', 'User::index');
$routes->get('/users/fetch', 'User::fetch');
$routes->post('/users/create', 'User::create');
$routes->get('/users/edit/(:num)', 'User::edit/$1');
$routes->post('/users/update/(:num)', 'User::update/$1');
$routes->delete('/users/delete/(:num)', 'User::delete/$1');

