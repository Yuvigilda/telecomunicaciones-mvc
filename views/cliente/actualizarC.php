<main class="contenedor seccion">
    <h1>Actualizar cliente</h1>
    <a href="/clientes" class="boton boton-verde">Volver</a>
    <?php
    include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form class="formulario" method="POST">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Actualizar Cliente" class="boton-verde">
    </form>
</main>