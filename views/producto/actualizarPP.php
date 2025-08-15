<main class="contenedor seccion">
    <h1>Actualizar Producto</h1>
    <a href="/productos" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Actualizar Producto" class="boton-verde">
    </form>
</main>