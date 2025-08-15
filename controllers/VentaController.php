<?php

namespace Controllers;


use MVC\Router;
use Clases\Email;
use Clases\Ticket;
use Model\Producto;
use Model\Proveedor;
use Model\Vendedor;
use Model\Venta;

use Model\Servicio;
use Model\VentaServicio;
use Model\Cliente;

class VentaController
{

    public static function index(Router $router)
    {

        $ventas = Venta::all();
        $ventasS = VentaServicio::all();

        foreach ($ventas as $venta) {
            $venta->cliente = Cliente::find($venta->id_cliente);
            $venta->vendedor = Vendedor::find($venta->id_proveedor);

            $venta->producto = Producto::find($venta->id_producto);
        }
        foreach ($ventasS as $venta) {
            $venta->cliente = Cliente::find($venta->id_cliente);
            $venta->vendedor = Vendedor::find($venta->id_proveedor);

            $venta->servicio = Servicio::find($venta->id_servicio);
        }
        $router->render('venta/index', [
            'ventas' => $ventas,
            'ventasS' => $ventasS,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {

        $ventas = new Venta;

        // $servicios = Servicio::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $ventas->sincronizar($_POST);


            $alertas = $ventas->validar();

            if (empty($alertas)) {
                $ventas->guardar();
                $ventas = Venta::all();
                foreach ($ventas as $venta) {
                    $venta->cliente = Cliente::find($venta->id_cliente);
                    $venta->vendedor = Vendedor::find($venta->id_proveedor);

                    $venta->producto = Producto::find($venta->id_producto);
                }

                $email = new Ticket;

                $email->enviarTicketProducto($venta->cliente->nombre, $venta->producto->nombre, $venta->producto->descripcion, $venta->producto->precio, $venta->fecha);

                header('Location: /ventas');
            }
        }

        $router->render('venta/crearV', [
            'alertas' => $alertas,
            'ventas' => $ventas,
            // 'servicios' => $servicios

        ]);
    }

    public static function store(Router $router)
    {
        $ventas = new VentaServicio;
        $servicios = Servicio::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $ventas->sincronizar($_POST);
            $alertas = $ventas->validar();
            if (empty($alertas)) {
                $ventas->guardar();
                $ventas = VentaServicio::all();
                foreach ($ventas as $venta) {
                    $venta->cliente = Cliente::find($venta->id_cliente);
                    $venta->vendedor = Vendedor::find($venta->id_proveedor);

                    $venta->servicio = Servicio::find($venta->id_servicio);
                }

                $email = new Ticket;

                $email->enviarTicketServicio($venta->cliente->nombre, $venta->servicio->mbps, $venta->servicio->precio, $venta->fecha);


                header('Location: /ventas');
            }
        }

        $router->render('venta/ventaS', [
            'alertas' => $alertas,
            'ventas' => $ventas,
            'servicios' => $servicios

        ]);
    }

    // public static function actualizar(Router $router)
    // {
    //     if (!is_numeric($_GET['id'])) return;
    //     $ventas = Producto::find($_GET['id']);

    //     $alertas = [];
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $ventas->sincronizar($_POST);

    //         $alertas = $ventas->validar();

    //         if (empty($alertas)) {
    //             $ventas->guardar();
    //             header('Location: /ventas');
    //         }
    //     }
    //     $router->render('venta/actualizarV', [
    //         'ventas' => $ventas,
    //         'alertas' => $alertas
    //     ]);
    // }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (isset($_POST['id_s'])) {

                $id = $_POST['id_s'];

                $id =  filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {

                    $venta = VentaServicio::find($id);
                    $venta->Eliminar();
                    if ($venta) {
                        header('Location: /ventas');
                    }
                }
            } else {

                $id = $_POST['id'];

                $id =  filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {

                    $venta = Venta::find($id);
                    $venta->Eliminar();
                    if ($venta) {
                        header('Location: /ventas');
                    }
                }
            }
        }
    }
}
