<?php
    namespace Controllers;


use Model\Cliente;

    class APIClientes{
        public static function index()
        {
            $clientes = Cliente::all();
            echo json_encode($clientes);

        }
        public static function cliente()
        {
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id || $id < 1){
                echo json_encode([]);
                return;
            }
            $cliente = Cliente::find($id);
            echo json_encode($cliente, JSON_UNESCAPED_SLASHES);
        }
    }
?>