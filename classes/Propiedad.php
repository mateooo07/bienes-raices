<?php
namespace App;         

class Propiedad {

    protected static $db;
    protected static $columnas_DB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamientos", "creado", "vendedores_id"];

    protected static $errores = [];

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
        return ($resultado);
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

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){


        if(!$this->titulo){
            self::$errores[] = "Debes añadir un título";
        }

        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }

        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }


        if(!$this->estacionamientos){
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$this->vendedores_id){
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }


        return self::$errores;
    }

    public function setImagen($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public static function all(){
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);     
        
        return $resultado;
    }

    public static function consultarSQL($query){
        $resultado = self::$db->query($query);
        
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        $resultado -> free();

        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

}