<?php
require "../../includes/app.php";

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

estaAutenticado();

$errores = [];

$consultaVendedores = "SELECT * FROM vendedores";
$resultadoVendedores = mysqli_query($db, $consultaVendedores);

$propiedad = new Propiedad();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $propiedad = new Propiedad($_POST);

    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES["imagen"]["tmp_name"]) {
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES["imagen"]["tmp_name"])->cover(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    if (empty($errores)) {

        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES, 0777, true);
        }

        $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $resultado = $propiedad->guardar();

        if ($resultado) {
            header("Location: /admin?res=1");
            exit;
        }
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
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Casa de lujo en el lago"
                value="<?php echo htmlspecialchars($propiedad->titulo, ENT_QUOTES); ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="$3,000,000.00"
                value="<?php echo htmlspecialchars($propiedad->precio, ENT_QUOTES); ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($propiedad->descripcion, ENT_QUOTES); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" min="1" max="9"
                value="<?php echo htmlspecialchars($propiedad->habitaciones, ENT_QUOTES); ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" min="1" max="9"
                value="<?php echo htmlspecialchars($propiedad->wc, ENT_QUOTES); ?>">

            <label for="estacionamientos">Estacionamientos</label>
            <input type="number" id="estacionamientos" name="estacionamientos" min="0" max="9"
                value="<?php echo htmlspecialchars($propiedad->estacionamientos, ENT_QUOTES); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id">
                <option value="" disabled <?php echo empty($propiedad->vendedores_id) ? 'selected' : ''; ?>>-- Seleccione --</option>
                <?php while ($row = mysqli_fetch_assoc($resultadoVendedores)): ?>
                    <option value="<?php echo $row['id']; ?>"
                        <?php echo $propiedad->vendedores_id == $row['id'] ? 'selected' : ''; ?>>
                        <?php echo $row['nombre'] . ' ' . $row['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>
