<?php 
    require "includes/funciones.php";
    incluirTemplate("header");
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <form class="formulario">
            <fieldset>
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" placeholder="Tu Password" id="telefono">
            </fieldset>
            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>