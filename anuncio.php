<?php
    require "includes/app.php";
    $id = $_GET["id"];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    $db = conectarDB();

    if(!$id){
        header("location: /");
    }

    $limite = $limite ?? 20;
    $query = "SELECT * FROM propiedades WHERE id = {$id}";


    $resultado = mysqli_query($db, $query);

    if($resultado -> num_rows == 0){
        header("location: /");
    }

    $propiedad = mysqli_fetch_assoc($resultado);


    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"]; ?></h1>

    <img src="/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Imagen de <?php echo htmlspecialchars($propiedad["titulo"]); ?>" loading="lazy">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad["precio"]; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                <p><?php echo $propiedad["wc"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                <p><?php echo $propiedad["estacionamientos"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                <p><?php echo $propiedad["habitaciones"]; ?></p>
            </li>
        </ul>

        <p><?php echo nl2br(htmlspecialchars($propiedad["descripcion"])); ?></p>
    </div>
</main>

<?php
    mysqli_close($db);
    incluirTemplate("footer");
?>