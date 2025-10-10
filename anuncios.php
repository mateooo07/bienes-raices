<?php
    require "includes/funciones.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion">
        <h1>Casas y Departamentos en Venta</h1>
        <div class="contenedor-anuncios">
        <?php 
            include "includes/templates/anuncios.php"
        ?>
        </div>
        </div>
    </main>
<?php
    incluirTemplate("footer");
?>