<?php
    namespace Controllers;


use Model\Vendedor;

    class APIVendedores{
        public static function index()
        {
            $vendedores = Vendedor::all();
            echo json_encode($vendedores);

        }
        public static function cliente()
        {
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id || $id < 1){
                echo json_encode([]);
                return;
            }
            $vendedor = Vendedor::find($id);
            echo json_encode($vendedor, JSON_UNESCAPED_SLASHES);
        }
    }
?>