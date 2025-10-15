<?php
    require "../../includes/app.php";

    use App\Propiedad;

    estaAutenticado();

    $db = conectarDB();

    $errores = [];
    
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    $titulo = mysqli_real_escape_string($db, $_POST['titulo'] ?? '');
    $precio = mysqli_real_escape_string($db, $_POST['precio'] ?? '');
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] ?? '');
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitacion'] ?? '');
    $wc = mysqli_real_escape_string($db, $_POST['wc'] ?? '');
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] ?? '');
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor'] ?? '');
    $creado = date("Y/m/d");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $propiedad = new Propiedad($_POST);

        $propiedad -> guardar();

        $imagen = $_FILES["imagen"] ?? null;

        if (!$imagen || $imagen["error"] !== UPLOAD_ERR_OK) {
            $errores[] = "La imagen es obligatoria o hubo un error al subirla.";
        }

        if(!$titulo){
            $errores[] = "Debes añadir un título";
        }

        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de baños es obligatorio";
        }


        if(!$estacionamiento){
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen["name"] || $imagen["error"]){
            $errores[] = "La imagen es obligatoria";
        }

        $medida = 1000 * 40000;

        if($imagen["size"] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        if(empty($errores)){
            
            $carpetaImagenes = "../../imagenes/";

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes, 0777, true); // true permite crear carpetas intermedias si faltan
            }

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);


            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: /admin?res=1");
            }
        }

        
    }

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-amarillo">←</a>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" placeholder="Casa de Lujo en el Lago" name="titulo" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="$3,000,000.00" name="precio" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitacion">Habitación</label>
                <input type="number" id="habitacion" min="1" placeholder="1" max="9" name="habitaciones" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baño</label>
                <input type="number" id="wc" min="1" placeholder="1" max="9" name="wc" value="<?php echo $wc; ?>">

                <label for="estacionamientos">Estacionamiento</label>
                <input type="number" id="estacionamientos" min="1" placeholder="1" max="9" name="estacionamientos" value="<?php echo $estacionamiento; ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedores_id" >
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $row["id"] ? "selected" : ""; ?> value="<?php echo $row ["id"]; ?>"> <?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear" class="boton boton-verde">
        </form>
        

    </main>

<?php
    incluirTemplate("footer");
?>