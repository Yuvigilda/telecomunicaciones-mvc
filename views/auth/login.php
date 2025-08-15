<header class="header contenedor">

    <div class="login">

        <div class="imagen">
            <picture>
                <source srcset="build/img/ciudad-inteligente-futurista-con-tecnologia-de-red-global-5g.avif" type="image/avif">
                <source srcset="build/img/ciudad-inteligente-futurista-con-tecnologia-de-red-global-5g.webp" type="image/webp">
                <img loading="lazy" src="build/img/ciudad-inteligente-futurista-con-tecnologia-de-red-global-5g.jpg" alt="imagen login">
            </picture>
        </div>
        <form action="/" class="formulario" method="POST">
            <h2>Iniciar sesion</h2>

            <?php
            include_once __DIR__ . '/../templates/alertas.php';
            ?>


            <fieldset>
                <legend>Datos de Usuario</legend>
                <label for="email">Usuario:</label>
                <input type="text" id="email" placeholder="Email" name="email" value="<?php echo s($auth->email); ?>">

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="ontraseña" placeholder="Escribe tu contraseña" name="password">
            </fieldset>

            <input type="submit" value="Acceder" class="boton-login">

            <div class="acciones">
                <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
                <a href="/olvide">¿Olvidaste tu contraseña?</a>
            </div>
        </form>

    </div>
</header>