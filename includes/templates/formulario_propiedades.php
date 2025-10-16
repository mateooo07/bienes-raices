        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Casa de lujo en el lago"
                value="<?php echo htmlspecialchars($propiedad->titulo, ENT_QUOTES); ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="propiedad[precio]
            " placeholder="$3,000,000.00"
                value="<?php echo htmlspecialchars($propiedad->precio, ENT_QUOTES); ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
            <?php if($propiedad -> imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
            <?php endif; ?>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo htmlspecialchars($propiedad->descripcion, ENT_QUOTES); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" min="1" max="9"
                value="<?php echo htmlspecialchars($propiedad->habitaciones, ENT_QUOTES); ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="propiedad[wc]" min="1" max="9"
                value="<?php echo htmlspecialchars($propiedad->wc, ENT_QUOTES); ?>">

            <label for="estacionamientos">Estacionamientos</label>
            <input type="number" id="estacionamientos" name="propiedad[estacionamientos]" min="0" max="9"
                value="<?php echo htmlspecialchars($propiedad->estacionamientos, ENT_QUOTES); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Asignar vendedor</label>
            <select name="propiedad[vendedores_id]" id="vendedor">
                <option selected value="" disabled>-- Seleccione --</option>
                <?php foreach($vendedores as $vendedor): ?>
                    <option
                        <?php echo $propiedad['vendedores_id'] === $vendedor['id'] ? "selected" : ""; ?>
                        value="<?php echo htmlspecialchars($vendedor->id, ENT_QUOTES)?>"><?php echo htmlspecialchars($vendedor->nombre . " " .  $vendedor->apellido, ENT_QUOTES); ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>