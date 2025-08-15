<main class="contenedor seccion">
    <h1>Procesar pagos</h1>
    <a href="/pagos" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form action="" class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Pagar" class="boton-verde">
    </form>
</main>



<script src='build/js/cliente.js'></script>
<script src='build/js/vendedor.js'></script>
<script src='build/js/servicio.js'></script>
<script src='build/js/pagociente.js'></script>

