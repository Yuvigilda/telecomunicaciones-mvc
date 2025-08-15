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
use Model\Pago;

class PagoController
{

    public static function index(Router $router)
    {

        $pagos = Pago::all();



        foreach ($pagos as $pago) {
            $pago->cliente = Cliente::find($pago->id_cliente);
            $pago->vendedor = Vendedor::find($pago->id_proveedor);


            $pago->servicio = Servicio::find($pago->id_servicio);
        }

        $router->render('pago/index', [
            'pagos' => $pagos,

            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {

        $pagos = new Pago;

        $servicios = Servicio::all();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $pagos->sincronizar($_POST);


            $alertas = $pagos->validar();

            if (empty($alertas)) {
                $pagos->guardar();
                $pagos = Pago::all();
                foreach ($pagos as $pago) {
                    $pago->cliente = Cliente::find($pago->id_cliente);
                    $pago->vendedor = Vendedor::find($pago->id_proveedor);

                    $pago->servicio = Servicio::find($pago->id_servicio);
                }

                $email = new Ticket;

                $email->enviarTicketPago($pago->cliente->nombre, $pago->servicio->mbps, $pago->servicio->precio, $pago->fecha);

                header('Location: /pagos');
            }
        }

        $router->render('pago/crearPY', [
            'alertas' => $alertas,
            'pagos' => $pagos,
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

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $pago = Pago::find($id);
                $pago->Eliminar();
                if ($pago) {
                    header('Location: /pagos');
                }
            }
        }
    }
}
