<?php

namespace Model;

class Proveedor extends ActiveRecord
{
    protected static $tabla = 'proveedor';
    protected static $columnasDB = ['id', 'nombre','apellido', 'email', 'empresa', 'no_cuenta', 'telefono'];

    public $id; //campos de clase o porpiedades
    public $nombre;
    public $apellido;
    public $email;
    public $empresa;

   
    public $no_cuenta;
    public $colonia;
    public $telefono;




    //crear constructor

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->empresa = $args['empresa'] ?? '';
       
        $this->no_cuenta = $args['no_cuenta'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'debes añadir un nombre';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'debes añadir los apellidos';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'debes añadir un email';
        }
        if (!$this->empresa) {
            self::$alertas['error'][] = 'Debes añadir u nombre de la empresa ';
        
        }
        if (!$this->no_cuenta) {
            self::$alertas['error'][] = 'Añade un numero de cuenta  ';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'debes añadir un numero de telefono';
        }

        return self::$alertas;
      }
}
