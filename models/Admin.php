<?php

namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = "usuarios";
    protected static $columnas_DB = ["id", "email", "password"];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? null;
        $this->password = $args["password"] ?? null;

    }
    
}