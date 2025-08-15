<?php

namespace MVC;

class Router
{
    public function __construct() {}
    //ARREGLOS 
    public $rutasGet = [];
    public $rutasPost = [];
    //mmetodo que contiene una ruta y una funcion asociada
    public function get($url, $fn)
    {
        $this->rutasGet[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPost[$url] = $fn;
    }
    //metodos
    public function comprobarRutas()
    {

        // Proteger Rutas...
        session_start();

        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/clientes', '/proveedores', '/productos', '/pagos','/vendedores', '/crearC','/crearP','/crearPP','/crearV','crearVV','/crearS','/ventaS','/crearPY','/actualizarC','/actualizarPP','/actualizarP','/actualizarS','/actualizarVV'];

        $auth = $_SESSION['login'] ?? null;

        $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->rutasGet[$currentUrl] ?? null;
        } else {
            $fn = $this->rutasPost[$currentUrl] ?? null;
        }
        if (in_array($currentUrl, $rutas_protegidas) && !$auth) {
            header('Location: /login');
        }

        if ($fn) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Pagina No Encontrada o Ruta no valida";
        }
    }

    //mostrar una vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        //hace iniciar un buffer o almacenar dentro del buffer
        ob_start();
        include __DIR__ . "/views/$view.php";
        //limpamos el buffer y almacenando en la variable cotenido
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
