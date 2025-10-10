<?php
    require "../includes/config/database.php";
    $db = conectarDB();

    $query = "SELECT * FROM propiedades";

    $resultadoConsulta = mysqli_query($db, $query);
    
    $resultado = $_GET["res"] ?? null;
    require "../includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado === "1"):?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php elseif($resultado === "2"):?>
            <p class="alerta exito">Anuncio actualizado correctamente</p>
        <?php endif; ?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>
    
    <table class="tabla-propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $propiedad["id"] ?></td>
                    <td><?php echo $propiedad["titulo"]?></td>
                    <td><img src="/imagenes/<?php echo $propiedad["imagen"]?>" alt="imagen propiedad ..." class="imagen-tabla"></td>
                    <td>$<?php echo $propiedad["precio"] ?></td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"] ?>" class="boton-amarillo-block">Actualizar</a>
                        <a href="#" class="boton-rojo">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


<?php
    mysqli_close($db);
    incluirTemplate("footer");
?>