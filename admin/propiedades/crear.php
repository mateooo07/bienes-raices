<?php
require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();


$propiedad = new Propiedad();

$vendedores = Vendedor::all();

$errores = Propiedad::getErrores();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $propiedad = new Propiedad($_POST["propiedad"]);

    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES["propiedad"] ["tmp_name"]["imagen"]) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES["propiedad"] ["tmp_name"]["imagen"])->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    if (empty($errores)) {

        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES, 0777, true);
        }

        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->guardar();
    }
}

incluirTemplate("header");
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <a href="/admin" class="boton boton-amarillo">← Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <?php include "../../includes/templates/formulario_propiedades.php" ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>
