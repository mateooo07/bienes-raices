<?php 
require "app.php";
function incluirTemplate(string $nombreTemplate, bool $inicio = false){
    include TEMPLATES_URL . "/{$nombreTemplate}.php";
}