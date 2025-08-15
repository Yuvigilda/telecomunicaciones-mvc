<?php
    namespace Controllers;


use Model\Servicio;

    class APIServicios{
        public static function index()
        {
            $servicios = Servicio::all();
            echo json_encode($servicios);

        }
        public static function servicio()
        {
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id || $id < 1){
                echo json_encode([]);
                return;
            }
            $servicio = Servicio::find($id);
            echo json_encode($servicio, JSON_UNESCAPED_SLASHES);
        }
    }
?>