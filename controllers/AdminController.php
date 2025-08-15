<?php

namespace Controllers;

use MVC\Router;
use Clases\Email;
use Model\Cliente;

class AdminController
{
    public static function index(Router $router)
    {
        //mostrar nombre de usuario al inicar session 
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre']


        ]);
    }

    public static function cliente(Router $router)
    {
        $clientes = Cliente::all();
        $router->render('admin/cliente', [
            'clientes' => $clientes,
            'nombre' => $_SESSION['nombre']

        ]);
    }
}
