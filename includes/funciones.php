<?php 
require "app.php";
function incluirTemplate(string $nombreTemplate, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombreTemplate}.php";
}

function estaAutenticado() : bool{
    session_start();

    $auth = $_SESSION["login"];

    if($auth){
        return true;
    }

    return false;
}