<?php 
    $inicio = true;
    include "includes/templates/header.php" 
?>
    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eos perspiciatis aut, amet soluta laudantium animi eum ducimus accusantium error itaque repellendus quam possimus placeat? Ratione iusto amet esse debitis.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eos perspiciatis aut, amet soluta laudantium animi eum ducimus accusantium error itaque repellendus quam possimus placeat? Ratione iusto amet esse debitis.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit eos perspiciatis aut, amet soluta laudantium animi eum ducimus accusantium error itaque repellendus quam possimus placeat? Ratione iusto amet esse debitis.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <source srcset="build/img/anuncio1.jpg" type="image/jpg">
                    <img src="build/img/anuncio1.jpg" alt="anuncio 1 imagen" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsam doloribus fuga quasi placeat sint.</p>
                    <p class="precio">$3,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                            <p>4</p>
                        </li>
                    </ul>

                    <a href="anuncio.php" class="boton-amarillo-block">Ver propiedad</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <source srcset="build/img/anuncio2.jpg" type="image/jpg">
                    <img src="build/img/anuncio2.jpg" alt="anuncio 2 imagen" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa  de Lujo</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsam doloribus fuga quasi placeat sint.</p>
                    <p class="precio">$2,500,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono"src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                            <p>4</p>
                        </li>
                    </ul>

                    <a href="anuncio.php" class="boton-amarillo-block">Ver propiedad</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <source srcset="build/img/anuncio3.jpg" type="image/jpg">
                    <img src="build/img/anuncio3.jpg" alt="anuncio 1 imagen" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con Alberca</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsam doloribus fuga quasi placeat sint.</p>
                    <p class="precio">$4,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                            <p>4</p>
                        </li>
                    </ul>

                    <a href="anuncio.php" class="boton-amarillo-block">Ver propiedad</a>
                </div>
            </div>
        </div>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blogs1.jpg" type="image/jpg">
                        <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="info-meta">Escrito el <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Consejos para construir una terraza en el techo de tu casa con lo mejores materiales y ahorrando dinero
                        </p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blogs2.jpg" type="image/jpg">
                        <img src="build/img/blog2.jpg" alt="Texto Entrada Blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="info-meta">Escrito el <span>15/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio.
                        </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Francisco Pavoni</p>
            </div>
        </section>
    </div>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2025 &copy;</p>
    </footer>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>