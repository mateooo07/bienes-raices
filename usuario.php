<?php

require "includes/config/database.php";
$db = conectarDB();

$email = "correodeejemplo@correo.com";
$password = "123456";

$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$password}')";

mysqli_query($db, $query);
