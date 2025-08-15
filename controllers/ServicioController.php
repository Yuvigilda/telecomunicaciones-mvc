<?php

namespace Controllers;


use MVC\Router;
use Clases\Email;
use Model\Cliente;
use Model\Usuario;
use Model\Servicio;

class ServicioController
{

    public static function index(Router $router)
    {

        $servicios = Servicio::all();

        $router->render('servicio/index', [
            'servicios' => $servicios,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {
        $servicios = new Servicio;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicios->sincronizar($_POST);
            $alertas = $servicios->validar();
            if (empty($alertas)) {
                $servicios->guardar();

                header('Location: /servicios');
            }
        }
        $router->render('servicio/crearS', [
            'alertas' => $alertas,
            'servicios' => $servicios

        ]);
    }
    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;
        $servicios = Servicio::find($_GET['id']);

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicios->sincronizar($_POST);

            $alertas = $servicios->validar();

            if (empty($alertas)) {
                $servicios->guardar();
                header('Location: /servicios');
            }
        }
        $router->render('servicio/actualizarS', [
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $servicio = Servicio::find($id);
                $servicio->Eliminar();
                if ($servicio) {
                    header('Location: /servicios');
                }
            }
        }
    }
}
