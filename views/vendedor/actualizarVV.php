<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/vendedores" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Actualizar Vendedor" class="boton-verde">
    </form>
</main>