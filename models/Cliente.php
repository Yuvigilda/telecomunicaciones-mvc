<?php

namespace Model;

class Cliente extends ActiveRecord{
    protected static $tabla = 'cliente';
    protected static $columnasDB = ['id', 'nombre', 'email','telefono','rfc','localidad','colonia','calle', 'municipio' ];

    public $id;//campos de clase o porpiedades
    public $nombre;
    public $email;
    public $telefono;
    
    public $rfc;
    public $localidad;
    public $colonia;
    public $calle;
    public $municipio;

    public $fecha;
    public $precio;
  

    //crear constructor

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->localidad = $args['localidad'] ?? '';
        $this->colonia = $args['colonia'] ?? '';
        $this->calle = $args['calle'] ?? '';
        $this->municipio = $args['municipio'] ?? '';
       
    }
    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'debes añadir un nombre';

        } if(!$this->email){
            self::$alertas['error'][] = 'debes añadir un email';

        } if(!$this->telefono){
            self::$alertas['error'][] = 'debes añadir un numero de telefono';
         }
         if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$alertas['error'][] = 'formato invalido';
       

        } if(!$this->rfc){
            self::$alertas['error'][] = 'Añade un  rfc ';

        } if(!$this->localidad){
            self::$alertas['error'][] = 'es necesario ingresar la localidad';

        } if(!$this->colonia){
            self::$alertas['error'][] = 'Añade la localidad ';

        } if(!$this->calle){
            self::$alertas['error'][] = 'Añade la calle';

        } if(!$this->municipio){
            self::$alertas['error'][] = 'Añade  el municipio';

        }
        return self::$alertas;
    }


}
?>