<?php

namespace Model;

class Venta extends ActiveRecord
{
    protected static $tabla = 'ventas';
    protected static $columnasDB = ['id', 'fecha', 'id_cliente', 'id_proveedor', 'id_producto'];

    public $id; //campos de clase o porpiedades
    public $fecha;

    public $id_cliente;
    public $id_proveedor;

    public $id_producto;

    public $cliente;
    public $vendedor;

    public $producto;

    //crear constructor

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Mexico_City');
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? date('Y-m-d H:i:s');

        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->id_proveedor = $args['id_proveedor'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
    }
    public function validar()
    {
        if (!$this->id_cliente) {
            self::$alertas['error'][] = 'debes  seleccionar un cliente ';
        }
        if (!$this->id_proveedor) {
            self::$alertas['error'][] = 'debes seleccionar un vendedor';
        }

        if (!$this->id_producto) {
            self::$alertas['error'][] = 'debes seleccionar un producto';
        }

         return self::$alertas;
    }
}
