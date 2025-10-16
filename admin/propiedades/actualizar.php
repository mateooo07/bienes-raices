<?php
    require "../../includes/app.php";
    use App\Propiedad;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;
    estaAutenticado();

    $id = $_GET["id"];

    $id= filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    $errores = Propiedad::getErrores();

    $propiedad = Propiedad::find($id);
    
    $consulta = "SELECT * FROM vendedores";
    $resultadoVendedores = mysqli_query($db, $consulta);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $args = $_POST["propiedad"];

        $propiedad->sincronizar($args);

        $errores = $propiedad->validar();

        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        if (empty($errores)) {

            if (isset($imagen)) {
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();
        }
    }

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <a href="/admin" class="boton boton-amarillo">←</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_propiedades.php" ?>
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
        

    </main>

<?php
    incluirTemplate("footer");
?>