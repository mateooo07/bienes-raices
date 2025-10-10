<?php
    require "includes/funciones.php";
    incluirTemplate("header");
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="imagen de la propiedad" loading="lazy">
        </picture>
        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono baños" loading="lazy">
                    <p>5</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamientos" loading="lazy">
                    <p>4</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                    <p>6</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero, vel sit ipsa, repellat nemo nam quas quis ad ipsum, obcaecati nostrum accusamus molestias deserunt dolorem assumenda commodi non. Omnis, porro.
            Iste aut deleniti a quod esse nisi laudantium enim tempora hic explicabo perferendis, cupiditate libero at possimus suscipit non vero asperiores voluptate cum assumenda? Iste ipsam repudiandae rerum doloremque dignissimos!
            Quam placeat omnis doloremque delectus cumque deserunt corrupti quia quaerat! Porro veritatis architecto dolore velit aut, sint at quam ex nam, rem vero nihil voluptas iste nobis? Cumque, aliquid architecto?
            Molestias delectus doloribus dignissimos magni earum, veniam consectetur. Reprehenderit illum quia molestiae minima, maiores ex unde perferendis, veritatis fugiat placeat aliquid excepturi! Fugiat, assumenda. Illum natus ipsa officiis optio quod.
            Harum expedita, ratione eius repudiandae quis atque deserunt voluptates mollitia praesentium nostrum beatae, et laudantium quaerat rem tempora quae saepe, tenetur temporibus perferendis sint autem quam cumque. Aut, ipsum officiis.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit facilis sunt atque quidem recusandae repudiandae ipsum inventore exercitationem. Ea totam in dolorem ipsam natus vel voluptatem minus qui, deserunt excepturi!
            Ullam laboriosam exercitationem earum pariatur voluptatibus distinctio quia expedita explicabo, fuga nostrum fugit, veniam, adipisci animi ut nulla! Eum dolorum, totam consequuntur quod non quisquam laborum! Numquam dolorem qui dolor.
            Hic quas necessitatibus, qui officia maxime dolores magni voluptates maiores quibusdam facilis aliquam assumenda temporibus minima delectus vel debitis cupiditate ad adipisci magnam cumque nemo rerum? Earum architecto optio corrupti!
            Eius, suscipit facere ad fuga excepturi sint quod tempore quisquam perspiciatis cum alias minus fugit enim placeat eligendi dolorum maxime nihil vero omnis. Placeat est nisi eaque, incidunt repellendus quos?
            Amet totam magni expedita iste, consectetur, nemo, dolor nostrum qui iusto aliquam eos laboriosam vero eligendi non explicabo. Veniam mollitia labore tenetur nam sunt minima incidunt ipsa doloremque cum tempore?
            Neque atque, provident incidunt culpa beatae sequi. Id aut odit ipsa modi error doloremque vero architecto sed aliquid, recusandae saepe tempora! Libero voluptates architecto nisi quibusdam officia ipsam temporibus! Vero?</p>
        </div>

    </main>
<?php
    incluirTemplate("footer");
?>