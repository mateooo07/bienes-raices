<?php

    require "includes/config/database.php";

    $db = conectarDB();

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST["password"]);

        if(!$email){
            $errores[] = "El email no es válido";
        }

        if(!$password){
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){
            $query = "SELECT * FROM usuarios WHERE EMAIL = '{$email}'";

            $resultado = mysqli_query($db, $query);

            if($resultado -> num_rows){
                $usuario = mysqli_fetch_assoc($resultado);

                $auth = password_verify($password, $usuario["password"]);

                if($auth){
                    session_start();
                    
                    $_SESSION["usuario"] = $usuario["email"];
                    $_SESSION["login"] = true; 
                }else{
                    $errores[] = "La contraseña es incorrecta";
                }

            }else{
                $errores[] = "El usuario con el email proporcionado no existe";
            }
        }
    }

    require "includes/funciones.php";
    incluirTemplate("header");
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>

        <form class="formulario" method="post">
            <fieldset>
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="telefono" required>
            </fieldset>
            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>