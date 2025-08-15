<?php

use function PHPSTORM_META\type;

include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Clientes</h2>
    <a href="/crearC" class="boton boton-verde">Nuevo Cliente</a>


    <table class="propiedad">
        <thead>
            <tr>
                <th>Nombre</th>

                <th>Emial</th>
                <th>Telefono</th>
                <th>RFC</th>
                <th>Fecha contrato</th>
                <th>Recordatorio</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente->nombre; ?></td>
                    <td><?php echo $cliente->email; ?></td>
                    <td><?php echo $cliente->telefono; ?></td>
                    <td><?php echo $cliente->rfc; ?></td>

                    <td><?php echo $cliente->fecha->fecha; ?></td>
                    <form action="" method="POST" class="w-100">
                             <input type="hidden" name="id" value=" <?php echo $cliente->id; ?>">
                      
                        <input type="hidden" name="cliente" value=" <?php echo $cliente->nombre; ?>">
          
                        <td><button type="submit" class="boton-amarillo-block">Enviar</button></td>

                    </form>

                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $cliente->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/actualizarC?id=<?php echo $cliente->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</main>