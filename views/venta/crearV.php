<main class="contenedor seccion">
    <h1>Crear Venta de Productos</h1>
    <a href="/ventas" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form action="" class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Crear Venta" class="boton-verde">
    </form>
</main>



<script src='build/js/cliente.js'></script>
<script src='build/js/vendedor.js'></script>
<script src='build/js/producto.js'></script>