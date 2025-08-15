<?php

namespace Controllers;


use MVC\Router;
use Clases\Email;
use Model\Producto;
use Model\Proveedor;
use Model\Usuario;

class ProductoController
{

    public static function index(Router $router)
    {

        $productos = Producto::all();

        $router->render('producto/index', [
            'productos' => $productos,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {
        $productos = new Producto;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productos->sincronizar($_POST);
            $alertas = $productos->validar();
            if (empty($alertas)) {
                $productos->guardar();

                header('Location: /productos');
            }
        }
        $router->render('producto/crearPP', [
            'alertas' => $alertas,
            'productos' => $productos

        ]);
    }
    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;
        $productos = Producto::find($_GET['id']);

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productos->sincronizar($_POST);

            $alertas = $productos->validar();

            if (empty($alertas)) {
                $productos->guardar();
                header('Location: /productos');
            }
        }
        $router->render('producto/actualizarPP', [
            'productos' => $productos,
            'alertas' => $alertas
        ]);
    }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $producto = Producto::find($id);
                $producto->Eliminar();
                if ($producto) {
                    header('Location: /productos');
                }
            }
        }
    }
}
