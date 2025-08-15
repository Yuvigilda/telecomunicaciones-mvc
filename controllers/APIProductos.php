<?php
    namespace Controllers;


use Model\Producto;

    class APIProductos{
        public static function index()
        {
            $productos = Producto::all();
            echo json_encode($productos);

        }
        public static function producto()
        {
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id || $id < 1){
                echo json_encode([]);
                return;
            }
            $producto = Producto::find($id);
            echo json_encode($producto, JSON_UNESCAPED_SLASHES);
        }
    }
?>