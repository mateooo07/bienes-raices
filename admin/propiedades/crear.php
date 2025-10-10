<?php 
    require "../../includes/config/database.php";

    $db = conectarDB();

    require "../../includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-amarillo">←</a>
        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" placeholder="Casa de Lujo en el Lago">

                <label for="precio">Precio</label>
                <input type="number" id="precio" placeholder="$3,000,000.00">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input type="number" id="habitaciones" min="1" value="1" max="9">

                <label for="baños">Baños</label>
                <input type="number" id="baños" min="1" value="1" max="9">

                <label for="estacionamientos">Estacionamientos</label>
                <input type="number" id="estacionamientos" min="0" value="0" max="9">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                
                <select>
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