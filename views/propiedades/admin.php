<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <?php
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));

            if($mensaje){?>
            <p class="alerta exito"><?php echo htmlspecialchars($mensaje, ENT_QUOTES);?></p>
    <?php   }
        } 
    ?>
    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>
</main>

<h2>Propiedades</h2>
<table class="tabla-propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td>
                    <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad" class="imagen-tabla">
                </td>
                <td>$<?php echo $propiedad->precio; ?></td>
                <td>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    
                    <form method="POST" class="w-100" onsubmit="return confirm('¿Deseas eliminar esta propiedad?');">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" value="Eliminar" class="boton-rojo">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <h2>Vendedores</h2>
    <table class="tabla-propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre .  " " .  $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        
                        <form method="POST" class="w-100" onsubmit="return confirm('¿Deseas eliminar este vendedor?');">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" value="Eliminar" class="boton-rojo">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>