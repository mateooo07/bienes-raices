<?php
namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = "vendedores";
    protected static $columnas_DB = ["id", "nombre", "apellido", "telefono"];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []){
        $this->id = $args["id"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre al vendedor";
        }

        if(!$this->apellido){
            self::$errores[] = "Debes añadir un apellido al vendedor";
        }

        if(!$this->telefono){
            self::$errores[] = "Debes añadir un teléfono al vendedor";
        }

        if(!preg_match("/[0-9]{10}/", $this->telefono)){
            self::$errores[] = "El formato del teléfono no es valido";
        }

        return self::$errores;
    }
    
}