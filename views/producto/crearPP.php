<main class="contenedor seccion">
    <h1>Crear Producto</h1>
    <a href="/productos" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form action="" class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Crear Producto" class="boton-verde">
    </form>
</main>