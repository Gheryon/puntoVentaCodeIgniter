<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UsuariosController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
 $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UsuariosController::login');

$routes->get('Productos', 'Productos::index');
$routes->get('Productos/eliminados', 'Productos::eliminados');
$routes->get('Productos/nuevo', 'Productos::nuevo');
$routes->get('Productos/editar/(:num)', 'Productos::editar/$1');
$routes->get('Productos/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->get('Productos/reinsertar/(:num)', 'Productos::reinsertar/$1');
$routes->get('Productos/buscar_por_codigo/(:segment)', 'Productos::buscar_por_codigo/$1');
$routes->post('Productos/insertar', 'Productos::insertar');
$routes->post('Productos/actualizar', 'Productos::actualizar');

$routes->get('Unidades', 'Unidades::index');
$routes->get('Unidades/eliminados', 'Unidades::eliminados');
$routes->get('Unidades/nuevo', 'Unidades::nuevo');
$routes->get('Unidades/editar/(:num)', 'Unidades::editar/$1');
$routes->get('Unidades/eliminar/(:num)', 'Unidades::eliminar/$1');
$routes->get('Unidades/reinsertar/(:num)', 'Unidades::reinsertar/$1');
$routes->post('Unidades/insertar', 'Unidades::insertar');
$routes->post('Unidades/actualizar', 'Unidades::actualizar');

$routes->get('Categorias', 'Categorias::index');
$routes->get('Categorias/eliminados', 'Categorias::eliminados');
$routes->get('Categorias/nuevo', 'Categorias::nuevo');
$routes->get('Categorias/editar/(:num)', 'Categorias::editar/$1');
$routes->get('Categorias/eliminar/(:num)', 'Categorias::eliminar/$1');
$routes->get('Categorias/reinsertar/(:num)', 'Categorias::reinsertar/$1');
$routes->post('Categorias/insertar', 'Categorias::insertar');
$routes->post('Categorias/actualizar', 'Categorias::actualizar');

$routes->get('Clientes', 'ClientesController::index');
$routes->get('Clientes/eliminados', 'ClientesController::eliminados');
$routes->get('Clientes/nuevo', 'ClientesController::nuevo');
$routes->get('Clientes/editar/(:num)', 'ClientesController::editar/$1');
$routes->get('Clientes/eliminar/(:num)', 'ClientesController::eliminar/$1');
$routes->get('Clientes/reinsertar/(:num)', 'ClientesController::reinsertar/$1');
$routes->post('Clientes/insertar', 'ClientesController::insertar');
$routes->post('Clientes/actualizar', 'ClientesController::actualizar');

$routes->get('Compras', 'ComprasController::index');
$routes->get('Compras/eliminados', 'ComprasController::eliminados');
$routes->get('Compras/Nuevo', 'ComprasController::nuevo');
$routes->get('Compras/editar/(:num)', 'ComprasController::editar/$1');
$routes->get('Compras/eliminar/(:num)', 'ComprasController::eliminar/$1');
$routes->get('Compras/reinsertar/(:num)', 'ComprasController::reinsertar/$1');
$routes->post('Compras/guardar', 'ComprasController::guardar');
$routes->post('Compras/actualizar', 'ComprasController::actualizar');


$routes->get('ComprasTemporal/insertar/(:num)/(:num)/(:segment)', 'ComprasTemporalController::insertar/$1/$2/$3');
$routes->get('ComprasTemporal/eliminar/(:num)/(:segment)', 'ComprasTemporalController::eliminar/$1/$2');

$routes->get('Usuarios', 'UsuariosController::index');
$routes->get('Usuarios/eliminados', 'UsuariosController::eliminados');
$routes->get('Usuarios/nuevo', 'UsuariosController::nuevo');
$routes->get('Usuarios/editar/(:num)', 'UsuariosController::editar/$1');
$routes->get('Usuarios/eliminar/(:num)', 'UsuariosController::eliminar/$1');
$routes->get('Usuarios/reinsertar/(:num)', 'UsuariosController::reinsertar/$1');
$routes->post('Usuarios/insertar', 'UsuariosController::insertar');
$routes->post('Usuarios/actualizar', 'UsuariosController::actualizar');
$routes->post('Usuarios/validar', 'UsuariosController::validar');
$routes->get('Usuarios/cerrar_sesion', 'UsuariosController::cerrar_sesion');
$routes->get('Usuarios/cambiar_pass', 'UsuariosController::cambiar_pass');
$routes->post('Usuarios/actualizarPassword', 'UsuariosController::actualizar_pass');

$routes->get('Configuracion', 'ConfiguracionController::index');
$routes->post('Configuracion/actualizar', 'ConfiguracionController::actualizar');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
