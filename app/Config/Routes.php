<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

/* Usar resource es un recurso RESTful  */
$routes->resource('clientes', ['controller' => 'Clientes']);

$routes->resource('Usuarios', ['controller' => 'Usuarios']);


$routes->group('administrator', function ($routes) {
    $routes->get('list-products', 'Administrator::list_products');
    $routes->get('create-product', 'Administrator::create_product');
    $routes->get('edit-product/(:num)', 'Administrator::edit/$1');
    
    // Para métodos POST/PUT/DELETE
    $routes->post('save-product', 'Administrator::save_product');
    $routes->put('update-product/(:num)', 'Administrator::update_product/$1');
    $routes->delete('delete-product/(:num)', 'Administrator::delete_product/$1');
});