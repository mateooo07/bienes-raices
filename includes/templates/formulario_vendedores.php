        <fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Juan Manuel"
                value="<?php echo htmlspecialchars($vendedor->nombre, ENT_QUOTES); ?>">

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Perez"
                value="<?php echo htmlspecialchars($vendedor->apellido, ENT_QUOTES); ?>">
        </fieldset>
        <fieldset>
            <legend>Información Extra</legend>
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="3516738231"
                value="<?php echo htmlspecialchars($vendedor->telefono, ENT_QUOTES); ?>">
        </fieldset>