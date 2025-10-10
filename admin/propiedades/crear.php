<?php 
    require "../../includes/config/database.php";

    $db = conectarDB();

    $errores = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitacion'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];

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
            $errores[] = "El número de baño es obligatorio";
        }


        if(!$estacionamiento){
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        if(empty($errores)){
            $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamientos, vendedores_id) VALUES ( '$titulo', '$precio','$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')";

            $resultado = mysqli_query($db, $query);
        }

        
    }

    require "../../includes/funciones.php";
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

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" placeholder="Casa de Lujo en el Lago" name="titulo">

                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="$3,000,000.00" name="precio">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitacion">Habitación</label>
                <input type="number" id="habitacion" min="1" value="1" max="9" name="habitacion">

                <label for="wc">Baño</label>
                <input type="number" id="wc" min="1" value="1" max="9" name="wc">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" id="estacionamiento" min="1" value="1" max="9" name="estacionamiento">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedor">
                    <option value="1">Mateo Francisco Pavoni</option>
                    <option value="2">Jeremías Guzmán</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear" class="boton boton-verde">
        </form>
        

    </main>

<?php
    incluirTemplate("footer");
?>