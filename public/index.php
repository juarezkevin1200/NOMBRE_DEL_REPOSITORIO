<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminPedidosController;
use Controllers\APIController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\CLientesController;
use Controllers\DashboardController;
use Controllers\PaginasController;
use Controllers\ProductosController;

$router = new Router();

$router->get('/', [PaginasController::class, 'index']);
//$router->post('/', [PaginasController::class, 'index']);
// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/recuperar', [AuthController::class, 'reestablecer']);
$router->post('/recuperar', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta

$router->get('/productos', [PaginasController::class, 'productos']);
$router->post('/productos/agregar-carrito', [PaginasController::class, 'agregarCarrito']);
$router->get('/pedidos', [PaginasController::class, 'carrito']);
$router->post('/pedidos/eliminar', [PaginasController::class, 'eliminar_carrito']);
$router->post('/pedidos/agregar-orden', [PaginasController::class, 'agregarOrden']);
$router->get('/pedidos/capture-order', [PaginasController::class, 'capturarOrden']);
$router->get('/pedidos/pagar', [PaginasController::class, 'pagar']);
$router->post('/pedidos/pagar', [PaginasController::class, 'pagar']);
$router->get('/pedidos/completado', [PaginasController::class, 'completado']);

$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Area de administración
$router->get('/admin/dashboard', [DashboardController::class, 'index']);


$router->get('/admin/productos', [ProductosController::class, 'index']);
$router->get('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->post('/admin/productos/crear', [ProductosController::class, 'crear']);
$router->get('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/editar', [ProductosController::class, 'editar']);
$router->post('/admin/productos/eliminar', [ProductosController::class, 'eliminar']);

$router->get('/admin/pedidos', [AdminPedidosController::class, 'index']);

$router->get('/admin/clientes', [CLientesController::class, 'index']);


$router->get('/admin/horarios', [ProductosController::class, 'index']);
// Registro de Usuarios
$router->get('/finalizar-registro', [RegistroController::class, 'crear']);

//API de productos
$router->get('/api/productos',[APIController::class,'index']);
$router->post('/api/citas',[APIController::class,'guardar']);
$router->post('/api/eliminar',[APIController::class,'eliminar']);

// Área Pública

$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/direccion', [PaginasController::class, 'direccion']);
$router->get('/404', [PaginasController::class, 'error']);


$router->comprobarRutas();