document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive)

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => {
        input.addEventListener("click", mostrarMetodosContacto);
    })
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");

    navegacion.classList.toggle("mostrar");
}

function darkMode() {
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    if (prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", function() {
        if (prefiereDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
    });
}

function mostrarMetodosContacto(event){
    const contactoDiv = document.querySelector("#contacto")

    if(event.target.value === "telefono"){
        contactoDiv.innerHTML = `
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]" pattern="[0-9]{7,15}" title="Ingrese solo números, mínimo 7 y máximo 15 dígitos">

            <p>Elija la fecha y hora para la llamada</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="contacto[hora]" min="09:00" max="18:00">
        `;
    }else{
        contactoDiv.innerHTML =  `
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}
