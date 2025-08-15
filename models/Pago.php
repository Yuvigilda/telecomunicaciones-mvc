<?php

namespace Model;
class Pago extends ActiveRecord{
    protected static $tabla = 'pagoservicio';
    protected static $columnasDB = ['id', 'fecha','id_cliente','id_proveedor','id_servicio' ];

    public $id;//campos de clase o porpiedades
    public $fecha;
   
    public $id_cliente;
    public $id_proveedor;
 
    public $id_servicio;

    public $cliente;
    public $vendedor;
  
    public $servicio;

    //crear constructor

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
         $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');

        $this->id_cliente = $args['id_cliente'] ?? '';
        $this->id_proveedor = $args['id_proveedor'] ?? '';
        $this->id_servicio = $args['id_servicio'] ?? '';
       
    }

      public function validar()
    {
        if (!$this->id_cliente) {
            self::$alertas['error'][] = 'debes  seleccionar un Cliente ';
        }
        if (!$this->id_proveedor) {
            self::$alertas['error'][] = 'debes seleccionar un Vendedor';
        }

        if (!$this->id_servicio) {
            self::$alertas['error'][] = 'debes seleccionar un Servicio';
        }

         return self::$alertas;
    }
}
?>