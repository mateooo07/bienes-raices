<main class="contenedor seccion">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="imagen contacto" loading="lazy">
    </picture>

    <?php 
        if($mensaje){
            echo '<p class="alerta error">{$mensaje}</p>';
        }
    ?>

    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="contacto[nombre]">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="contacto[nombre]" name="contacto[nombre]" required minlength="2" maxlength="50">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" placeholder="Escribe tu mensaje" required minlength="10" maxlength="500"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" min="0" step="any" required>
        </fieldset>

        <fieldset>
            <legend>Preferencia de contacto</legend>

            <p>Cómo desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input name="contacto[contacto]" type="radio" value="email" id="contactar-email">
            </div>

            <div id="contacto">

            </div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>
