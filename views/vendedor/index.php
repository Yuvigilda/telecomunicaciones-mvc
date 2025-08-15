<?php include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Vendedores</h2>
    <a href="/crearVV" class="boton boton-verde">Nuevo Vendedor</a>
 

    <table class="propiedad">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Emial</th>
                <th>Telefono</th>
                <th>RFC</th>
                <th>Colonia</th>
                <th>Calle</th>
                <th>Municipio</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->nombre; ?></td>
                    <td><?php echo $vendedor->email; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td><?php echo $vendedor->rfc; ?></td>
                   
                    <td><?php echo $vendedor->colonia; ?></td>
                    <td><?php echo $vendedor->calle; ?></td>
                    <td><?php echo $vendedor->municipio; ?></td>

                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $vendedor->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/actualizarVV?id=<?php echo $vendedor->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</main>