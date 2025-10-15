<?php
namespace App;         

class Propiedad {

    protected static $db;
    protected static $columnas_DB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamientos", "creado", "vendedores_id"];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamientos = $args["estacionamientos"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    public function guardar(){
        $atributos = $this->sanitizarAtributos();

        $columnas = join(", ", array_keys($atributos));

        $valores = "'" . join("', '", array_values($atributos)) . "'";

        $query = "INSERT INTO propiedades ($columnas) VALUES ($valores)";

        $resultado = self::$db->query($query);

        debugear($resultado);
    }


    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->real_escape_string($value);
        }

        return $sanitizado;
    }

    public function atributos(){
        $atributos = [];
        foreach(self::$columnas_DB as $columna){
            if($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public static function setDB($database){
        self::$db = $database;
    }
}