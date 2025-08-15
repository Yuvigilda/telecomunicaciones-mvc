<?php

namespace Controllers;


use MVC\Router;
use Clases\Email;
use Model\Vendedor;
use Model\Usuario;

class VendedorController
{

    public static function index(Router $router)
    {

        $vendedores = Vendedor::all();

        $router->render('vendedor/index', [
            'vendedores' => $vendedores,
            'nombre' => $_SESSION['nombre']

        ]);
    }
    public static function crear(Router $router)
    {
        $vendedores = new Vendedor;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedores->sincronizar($_POST);
            $alertas = $vendedores->validar();
            if (empty($alertas)) {
                $vendedores->guardar();

                header('Location: /vendedores');
            }
        }
        $router->render('vendedor/crearVV', [
            'alertas' => $alertas,
            'vendedores' => $vendedores

        ]);
    }
    public static function actualizar(Router $router)
    {
        if (!is_numeric($_GET['id'])) return;
        $vendedores = Vendedor::find($_GET['id']);

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vendedores->sincronizar($_POST);

            $alertas = $vendedores->validar();

            if (empty($alertas)) {
                $vendedores->guardar();
                header('Location: /vendedores');
            }
        }
        $router->render('vendedor/actualizarVV', [
            'vendedores' => $vendedores,
            'alertas' => $alertas
        ]);
    }
    public static function eliminar()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id =  filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $vendedor = Vendedor::find($id);
                $vendedor->Eliminar();
                if ($vendedor) {
                    header('Location: /vendedores');
                }
            }
        }
    }
}
