<?php
    require "../includes/app.php";
    use App\Propiedad;

    estaAutenticado();

    $propiedades = Propiedad::all();

    // Resultado de operaciones
    $resultado = $_GET["res"] ?? null;

    // Manejo de eliminación
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"] ?? null;
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $queryDelete = "DELETE FROM propiedades WHERE id = {$id}";
            $resDelete = mysqli_query($db, $queryDelete);

            $queryImagen = "SELECT imagen FROM propiedades WHERE id = {$id}";
            $resImagen = mysqli_query($db, $queryImagen);
            $propiedad = mysqli_fetch_assoc($resImagen);

            unlink("../imagenes/" . $propiedad["imagen"]);

            if ($resDelete) {
                header("Location: /admin?res=3"); 
            } 
        }
    }


    incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <?php if($resultado === "1"): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif($resultado === "2"): ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif($resultado === "3"): ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
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
        <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td>
                    <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad" class="imagen-tabla">
                </td>
                <td>$<?php echo $propiedad->precio; ?></td>
                <td>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    
                    <form method="POST" class="w-100" onsubmit="return confirm('¿Deseas eliminar esta propiedad?');">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="submit" value="Eliminar" class="boton-rojo">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
mysqli_close($db);
incluirTemplate("footer");
?>
