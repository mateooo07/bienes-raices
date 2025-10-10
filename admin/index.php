<?php
    $resultado = $_GET["res"] ?? null;
    require "../includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado === "1"):?>
            <p class="alerta exito">Anuncio creado correctamente</p>
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
            <tr>
                <td></td>
                <td></td>
                <td><img src="" alt="imagen propiedad ..." class="imagen-tabla"></td>
                <td>$</td>
                <td>
                    <a href="#" class="boton-amarillo-block">Actualizar</a>
                    <a href="#" class="boton-rojo">Eliminar</a>
                </td>
            </tr>
        </tbody>
    </table>


<?php
    incluirTemplate("footer");
?>