<main class="contenedor seccion">
    <h1>Crear Proveedor</h1>
    <a href="/proveedores" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form action="" class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Crear Proveedor" class="boton-verde">
    </form>
</main>