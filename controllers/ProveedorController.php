<?php

namespace Controllers;


use MVC\Router;
use Clases\Email;

use Model\Proveedor;
use Model\Usuario;

class ProveedorController
{

    public static function index(Router $router)
    {

        $proveedores = Proveedor::all();

        $router->render('proveedor/index', [
            'proveedores' => $proveedores,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {
        $proveedores = new Proveedor;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedores->sincronizar($_POST);
            $alertas = $proveedores->validar();
            if (empty($alertas)) {
                $proveedores->guardar();

                header('Location: /proveedores');
            }
        }
        $router->render('proveedor/crearP', [
            'alertas' => $alertas,
            'proveedores' => $proveedores

        ]);
    }
    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;
        $proveedores = Proveedor::find($_GET['id']);

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedores->sincronizar($_POST);

            $alertas = $proveedores->validar();

            if (empty($alertas)) {
                $proveedores->guardar();
                header('Location: /proveedores');
            }
        }
        $router->render('proveedor/actualizarP', [
            'proveedores' => $proveedores,
            'alertas' => $alertas
        ]);
    }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $proveedor = Proveedor::find($id);
                $proveedor->Eliminar();
                if ($proveedor) {
                    header('Location: /proveedores');
                }
            }
        }
    }
}
