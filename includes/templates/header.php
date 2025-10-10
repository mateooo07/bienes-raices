<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <script src="build/js/modernizr.js"></script>
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo isset($inicio) ? "inicio" : "" ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="icono menu">
                </div>

                <div class="derecha">
                    <img src="build/img/dark-mode.svg"" alt="dark mode icon" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
            </div> <!-- .barra -->
        </div>
    </header>