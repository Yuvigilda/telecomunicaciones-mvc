<?php

namespace Model;

class ActiveRecord
{
    protected static $db; //propiedades o campos de clases
    protected static $columnasDB = [];
    protected static $tabla = '';

    protected static $errores = [];
    protected static $alertas = [];

    public function guardar()
    {
        $resultado = '';
        if (!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    public function crear()
    {
        $atributos = $this->sanitizarDatos();
        $query =  "INSERT INTO " . static::$tabla . "(";
        $query .= join(',', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);

        return [
            'resultado' =>  $resultado,
            'id' => self::$db->insert_id
        ];
    }


    public function actualizar()
    {
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1 "; //actualizar un solo registro

        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function Eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // identificar y unir los atributos de la bd

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; // omite el id 
            //arreglo asociativo tiene llave y valor 
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado  = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value ?? '');
        }
        return $sanitizado;
    }
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function inner($id)
    {
        $query = "SELECT  
        
        cliente.nombre, 
        cliente.telefono, 
        vendedores.nombre, 
        servicio.mbps, 
        servicio.precio
        FROM pago
        LEFT JOIN cliente ON cliente.id = pago.id_cliente
        LEFT JOIN vendedores ON vendedores.id = pago.id_vendedor
        LEFT JOIN servicio ON servicio.id = pago.id_servicio
        WHERE pago.id = {$id}";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar memoria

        $resultado->free();
        //retornar datos
        return $array;
    }
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id} ";
        $resultado = self::consultarSQL($query);
        //retorna el primer elemento
        return array_shift($resultado);
    }
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
    public static function where($columna, $valor)
    {
        $query = 'SELECT * FROM ' . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function SQL($query)
    {
        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    public static function setAlerta($tipo, $mensaje)
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas()
    {
        return static::$alertas;
    }
}
