<?php 

require "funciones.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";


$db = conectarDB();

use Model\Propiedad;

Propiedad::setDB($db);
