<?php include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Pagos</h2>
    <a href="/crearPY" class="boton boton-verde">Realizar Pago</a>

    <table class="propiedad">
        <thead>
            <tr>

                <th>Cliente</th>
                <th>Cajero</th>
                <th>Paquete</th>
                <th>Precio</th>
                <th>Fecha</th>


            </tr>
        </thead>
        <tbody>

            <?php foreach ($pagos as $pago) : ?>
                <tr>

                    <td class="clientepago"><?php echo $pago->cliente->nombre; ?></td>
                    <td class="cajero"><?php echo $pago->vendedor->nombre; ?></td>

                    <td class="mbps">
                        <?php
                        echo $pago->servicio->mbps . 'mbps';
                        ?>

                    </td>
                    <td class="servicioprecio">
                        <?php
                        echo '$' . $pago->servicio->precio;
                        ?>
                    </td>
                    <td class="fechapago"><?php echo $pago->fecha; ?></td>
                    <td class="pago" style="display: none;"><?php echo $pago->servicio->precio; ?></td>

                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $pago->id; ?>">

                            <!-- <input type="botton" class="boton-verde-block" value="Descargar PDF"> -->
                            <button type="button" onclick="generarPDFPG(this)" class="boton-verde-block"> Descargar PDF</button>

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>






</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src='build/js/pdf.js'></script>