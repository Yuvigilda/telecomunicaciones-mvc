<?php

namespace Controllers;


use MVC\Router;
use Clases\Ticket;
use Model\Cliente;
use Model\Usuario;
use Model\VentaServicio;
use Model\Servicio;

class ClienteController
{

    public static function index(Router $router)
    {

        $clientes = Cliente::all();


        foreach ($clientes as $cliente) {
            $cliente->fecha = VentaServicio::find($cliente->id);
            
        }
        $router->render('cliente/index', [
            'clientes' => $clientes,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {
        $clientes = new Cliente;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientes->sincronizar($_POST);
            $alertas = $clientes->validar();
            if (empty($alertas)) {
                $clientes->guardar();

                header('Location: /clientes');
            }
        }
        $router->render('cliente/crearC', [
            'alertas' => $alertas,
            'clientes' => $clientes

        ]);
    }
    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;
        $clientes = Cliente::find($_GET['id']);

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientes->sincronizar($_POST);

            $alertas = $clientes->validar();

            if (empty($alertas)) {
                $clientes->guardar();
                header('Location: /clientes');
            }
        }
        $router->render('cliente/actualizarC', [
            'clientes' => $clientes,
            'alertas' => $alertas
        ]);
    }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $cliente = Cliente::find($id);
                $cliente->Eliminar();
                if ($cliente) {
                    header('Location: /clientes');
                }
            }
        }
    }

    public static function notify()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         

             $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);


           
            $cliente = $_POST['cliente'];

            if ($id) {

                $email = new Ticket;

                $email->notificacion($cliente);

                if ($email) {
                    header('Location: /clientes');
                }
            }
        }
    }
}
