<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

// Aquí puedes definir tus rutas para el módulo de administración
// Puedes usar el método group para agrupar rutas relacionadas
// y aplicar un prefijo común a todas ellas
$routes->group('administrator', function ($routes) {
    $routes->get('list-products', 'Administrator::list_products');
    $routes->get('create-product', 'Administrator::create_product');
    $routes->get('edit-product/(:num)', 'Administrator::edit/$1');
    
    $routes->get('list-users', 'Administrator::list_users');
    $routes->get('panel', 'Administrator::index');
});


/** 
 * Usar resource es un recurso RESTful
 * 
 * */
//$routes->resource('clientes', ['controller' => 'Clientes']);
//$routes->resource('Usuarios', ['controller' => 'Usuarios']);
// API
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->resource('usuarios'); // Esta línea expone todos los endpoints REST automáticamente
});

$routes->put('api/usuarios/activar/(:num)', 'Api\Usuarios::activate/$1');
