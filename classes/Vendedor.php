<?php

namespace App;

class Vendedor extends ActiveRecord{
    protected string $tabla = "vendedores";
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
    
}