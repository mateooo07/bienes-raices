<?php
    require "../../includes/funciones.php";

    $auth = estaAutenticado();

    if(!$auth){
        header("Location: /");
    }
    require "../../includes/config/database.php";

    $id = $_GET["id"];

    $id= filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    $db = conectarDB();

    $errores = [];

    $consultaPropiedad = "SELECT * FROM propiedades WHERE id = {$id}";

    $resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);
    
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamientos"];
    $vendedorId = $propiedad["vendedores_id"];
    $imagenPropiedad = $propiedad["imagen"];


    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $imagen = $_FILES["imagen"];

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

        $medida = 1000 * 20000;

        if($imagen["size"] > $medida){
            $errores[] = "La imagen es muy pesada";
        }

        if(empty($errores)){
            
            $carpetaImagenes = "../../imagenes/";

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes, 0777, true); // true permite crear carpetas intermedias si faltan
            }

            if($imagen["name"]){
                unlink($carpetaImagenes . $propiedad["imagen"]);

                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
            } else{
                $nombreImagen = $propiedad["imagen"];
            }

            

            $titulo = mysqli_real_escape_string($db, $_POST['titulo'] ?? '');
            $precio = mysqli_real_escape_string($db, $_POST['precio'] ?? '');
            $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] ?? '');
            $habitaciones = mysqli_real_escape_string($db, $_POST['habitacion'] ?? '');
            $wc = mysqli_real_escape_string($db, $_POST['wc'] ?? '');
            $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] ?? '');
            $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor'] ?? '');
            $creado = date("Y/m/d");

            $query = "UPDATE propiedades 
            SET 
                titulo = '{$titulo}',
                precio = '{$precio}',
                imagen = '{$nombreImagen}',
                descripcion = '{$descripcion}',
                habitaciones = '{$habitaciones}',
                wc = '{$wc}',
                estacionamientos = '{$estacionamiento}',
                vendedores_id = '{$vendedorId}'
            WHERE id = {$id}";


            $resultado = mysqli_query($db, $query);

            if($resultado){
                header("Location: /admin?res=2");
            }
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" placeholder="Casa de Lujo en el Lago" name="titulo" value="<?php echo $titulo; ?>">

                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="$3,000,000.00" name="precio" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitacion">Habitación</label>
                <input type="number" id="habitacion" min="1" placeholder="1" max="9" name="habitacion" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baño</label>
                <input type="number" id="wc" min="1" placeholder="1" max="9" name="wc" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" id="estacionamiento" min="1" placeholder="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedor" >
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $row["id"] ? "selected" : ""; ?> value="<?php echo $row ["id"]; ?>"> <?php echo $row["nombre"] . " " . $row["apellido"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
        

    </main>

<?php
    incluirTemplate("footer");
?>