<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::loginView');

// Aquí puedes definir tus rutas para el módulo de administración
// Puedes usar el método group para agrupar rutas relacionadas
// y aplicar un prefijo común a todas ellas
$routes->group('administrator', function ($routes) {
    $routes->get('/', 'Administrator::index');
    $routes->get('list-products', 'Administrator::list_products');
    $routes->get('create-product', 'Administrator::create_product');
    $routes->get('edit-product/(:num)', 'Administrator::edit/$1');
    $routes->get('list-category', 'Administrator::list_category');
    $routes->get('list-brands', 'Administrator::list_brands');
    $routes->get('list-users', 'Administrator::list_users');
    $routes->get('list_dispositivos', 'Administrator::list_dispositivos');
    $routes->get('crear_dispositivos', 'Administrator::crear_dispositivos');
    $routes->get('editar_dispositivos/(:num)', 'Administrator::editar_dispositivos/$1');
});


/** 
 * Usar resource es un recurso RESTful
 * 
 * */

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('auth/login', 'Auth::login');
    $routes->resource('usuarios');
    $routes->put('usuarios/activar/(:num)', 'Api\Usuarios::activate/$1');
    $routes->resource('productos');
    $routes->put('productos/activar/(:num)', 'Api\Productos::activate/$1');
    $routes->resource('lineas');
    $routes->resource('marcas');
    $routes->resource('impuestos');
    $routes->resource('dispositivos');
    $routes->get('prods_download/pendientes/(:any)', 'ProdsDownload::pendientes/$1');
    $routes->post('prods_download/aplicar', 'ProdsDownload::aplicar');
});
