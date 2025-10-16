<?php
namespace App;

class ActiveRecord {
    protected static $db;
    protected static $columnas_DB = [];
    protected static $tabla = "";

    protected static $errores = [];
    

    public function guardar(){
        if(!empty($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }
    
    public function actualizar(){
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .=  join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->real_escape_string($this->id) . "' ";
        $query.= " LIMIT 1 ";

        $resultado = self::$db -> query($query);

        if($resultado){
                header("Location: /admin?res=2");
        }
    }

    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->real_escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->eliminarImagen();
            header("Location: /admin?res=3");
            exit;
        }
        

        debugear($query);
    }

    public function eliminarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public function crear(){
        $atributos = $this->sanitizarAtributos();

        $columnas = join(", ", array_keys($atributos));

        $valores = "'" . join("', '", array_values($atributos)) . "'";

        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ($valores)";

        $resultado = self::$db->query($query);
        
        if($resultado){
            header("Location: /admin?res=1");
        }
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
        if(!empty($this->id)){
            $this->eliminarImagen();
        }

        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);     

        return $resultado;
    }

    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::consultarSQL($query);
        
        return array_shift($resultado);
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
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}