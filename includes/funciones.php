<?php 

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");

function incluirTemplate(string $nombreTemplate, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombreTemplate}.php";
}

function estaAutenticado() : bool{
    session_start();

    if(!$_SESSION["login"]){
        header("Location: /");
    }

    return false;
}

function debugear($variable){
    echo"<pre>";
    var_dump($variable);
    echo"</pre>";
    exit;
}