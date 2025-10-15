<?php
    require "../../includes/app.php";
    use App\Propiedad;
    estaAutenticado();

    $id = $_GET["id"];

    $id= filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /admin");
    }

    $db = conectarDB();

    $errores = [];

    $propiedad = Propiedad::find($id);
    
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    $titulo = $propiedad->titulo;
    $precio = $propiedad->precio;
    $descripcion = $propiedad->descripcion;
    $habitaciones = $propiedad->habitaciones;
    $wc = $propiedad->wc;
    $estacionamiento = $propiedad->estacionamientos;
    $vendedorId = $propiedad->vendedores_id;
    $imagenPropiedad = $propiedad->imagen;


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
            <?php include "../../includes/templates/formulario_propiedades.php" ?>
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </form>
        

    </main>

<?php
    incluirTemplate("footer");
?>