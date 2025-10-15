<?php 
$db = conectarDB();

$limite = 3;
$query = "SELECT * FROM propiedades LIMIT {$limite}";
$resultado = mysqli_query($db, $query);

function limitarTexto($texto, $maxCaracteres = 100) {
    if (mb_strlen($texto) <= $maxCaracteres) {
        return $texto;
    }
    $textoCortado = mb_substr($texto, 0, $maxCaracteres);
    $ultimoEspacio = mb_strrpos($textoCortado, ' ');
    if ($ultimoEspacio !== false) {
        $textoCortado = mb_substr($textoCortado, 0, $ultimoEspacio);
    }
    return $textoCortado . '...';
}
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
        <img src="/imagenes/<?php echo $propiedad["imagen"] ?>" alt="anuncio imagen" loading="lazy">

        <div class="contenido-anuncio">
        <h3><?php echo $propiedad["titulo"]?></h3>
        <p><?php echo limitarTexto($propiedad["descripcion"], 100); ?></p> 
        <p class="precio">$<?php echo $propiedad["precio"]?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                <p><?php echo $propiedad["wc"]?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                <p><?php echo $propiedad["estacionamientos"]?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                <p><?php echo $propiedad["habitaciones"]?></p>
            </li>
        </ul>

        <a href="anuncio.php?id=<?php echo $propiedad["id"]; ?>" class="boton-amarillo-block">Ver propiedad</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>
