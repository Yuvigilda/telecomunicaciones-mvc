<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIClientes;
use Controllers\APIPagos;
use Controllers\APIProductos;
use Controllers\APIServicios;
use Controllers\APIVendedores;
use Controllers\ClienteController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\PagoController;
use Controllers\ProductoController;
use Controllers\ProveedorController;
use Controllers\ServicioController;
use Controllers\VendedorController;
use Controllers\VentaController;

$router = new Router();

$router->get('/login',[loginController::class,'login']);
$router->post('/login',[loginController::class,'login']);
$router->get('/logout',[loginController::class,'logout']);

$router->get('/olvide',[loginController::class,'olvide']);
$router->post('/olvide',[loginController::class,'olvide']);

$router->get('/recuperar',[loginController::class,'recuperar']);
$router->post('/recuperar',[loginController::class,'recuperar']);



$router->post('/crear-cuenta',[loginController::class,'crear']);
$router->get('/crear-cuenta',[loginController::class,'crear']);
$router->get('/mensaje',[loginController::class,'mensaje']);

$router->get('/confirmar-cuenta',[loginController::class,'confirmar']);

$router->get('/admin',[AdminController::class,'index']);

$router->get('/clientes',[ClienteController::class,'index']);
$router->get('/crearC',[ClienteController::class,'crear']);
$router->post('/crearC',[ClienteController::class,'crear']);
$router->get('/actualizarC',[ClienteController::class,'actualizar']);
$router->post('/actualizarC',[ClienteController::class,'actualizar']);
$router->post('/clientes',[ClienteController::class,'eliminar']);
$router->post('/clientes',[ClienteController::class,'notify']);

$router->get('/proveedores',[ProveedorController::class,'index']);
$router->get('/crearP',[ProveedorController::class,'crear']);
$router->post('/crearP',[ProveedorController::class,'crear']);
$router->get('/actualizarP',[ProveedorController::class,'actualizar']);
$router->post('/actualizarP',[ProveedorController::class,'actualizar']);
$router->post('/proveedores',[ProveedorController::class,'eliminar']);

$router->get('/vendedores',[VendedorController::class,'index']);
$router->get('/crearVV',[VendedorController::class,'crear']);
$router->post('/crearVV',[VendedorController::class,'crear']);
$router->get('/actualizarVV',[VendedorController::class,'actualizar']);
$router->post('/actualizarVV',[VendedorController::class,'actualizar']);
$router->post('/vendedores',[VendedorController::class,'eliminar']);

$router->get('/productos',[ProductoController::class,'index']);
$router->get('/crearPP',[ProductoController::class,'crear']);
$router->post('/crearPP',[ProductoController::class,'crear']);
$router->get('/actualizarPP',[ProductoController::class,'actualizar']);
$router->post('/actualizarPP',[ProductoController::class,'actualizar']);
$router->post('/productos',[ProductoController::class,'eliminar']);

$router->get('/servicios',[ServicioController::class,'index']);
$router->get('/crearS',[ServicioController::class,'crear']);
$router->post('/crearS',[ServicioController::class,'crear']);
$router->get('/actualizarS',[ServicioController::class,'actualizar']);
$router->post('/actualizarS',[ServicioController::class,'actualizar']);
$router->post('/servicios',[ServicioController::class,'eliminar']);

$router->get('/ventas',[VentaController::class,'index']);
$router->get('/crearV',[VentaController::class,'crear']);
$router->post('/crearV',[VentaController::class,'crear']);
$router->get('/ventaS',[VentaController::class,'store']);
$router->post('/ventaS',[VentaController::class,'store']);
$router->post('/ventas',[VentaController::class,'eliminar']);

$router->get('/pagos',[PagoController::class,'index']);
$router->get('/crearPY',[PagoController::class,'crear']);
$router->post('/crearPY',[PagoController::class,'crear']);
$router->post('/pagos',[PagoController::class,'eliminar']);

$router->get('/api/clientes',[APIClientes::class,'index']);
$router->get('/api/cliente',[APIClientes::class,'cliente']);

$router->get('/api/vendedores',[APIVendedores::class,'index']);
$router->get('/api/vendedor',[APIVendedores::class,'vendedor']);



$router->get('/api/productos',[APIProductos::class,'index']);
$router->get('/api/producto',[APIProductos::class,'producto']);


$router->get('/api/pagos',[APIPagos::class,'index']);
$router->get('/api/pago',[APIPagos::class,'pago']);



$router->comprobarRutas();

?>