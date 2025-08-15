<?php

namespace Model;

class Servicio extends ActiveRecord{
    protected static $tabla = 'servicio';
    protected static $columnasDB = ['id', 'mbps','precio' ];

    public $id;//campos de clase o porpiedades
    public $mbps;
    public $precio;
 
  

  

    //crear constructor

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
         $this->mbps = $args['mbps'] ?? '';
        $this->precio = $args['precio'] ?? '';
    

       
    }

        public function validar()
    {
        if (!$this->mbps) {
            self::$alertas['error'][] = 'debes la velocidad del paquete ';
        }
        if (!$this->precio) {
            self::$alertas['error'][] = 'debes añadir el precio';
        }
     }

}
