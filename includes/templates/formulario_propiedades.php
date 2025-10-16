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

            <select name="propiedad[vendedores_id]">
                <option value="" disabled <?php echo empty($propiedad->vendedores_id) ? 'selected' : ''; ?>>-- Seleccione --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultadoVendedores)): ?>
                    <option value="<?php echo $vendedor['id']; ?>"
                        <?php echo $propiedad->vendedores_id == $vendedor['id'] ? 'selected' : ''; ?>>
                        <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>