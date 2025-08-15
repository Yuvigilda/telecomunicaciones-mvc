<?php include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Ventas</h2>
    <a href="/crearV" class="boton boton-verde">Producto</a>
    <a href="/ventaS" class="boton boton-verde">Servicio</a>
    <table class="propiedad">
        <thead>
            <tr>

                <th>Cliente</th>
                <th>Vendedor</th>

                <th>Producto</th>
                <th>Fecha</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($ventas as $venta) : ?>
                <tr>

                    <td class="ncliente"><?php echo $venta->cliente->nombre; ?></td>
                    <td class="nvendedor"><?php echo $venta->vendedor->nombre; ?></td>

                    <td class="descripcion">
                        <?php
                        echo $venta->producto->descripcion;
                        ?>
                    </td>
                    <td class="fechaV"><?php echo $venta->fecha; ?></td>
                    <td class="precioV" style="display: none;"><?php echo $venta->producto->precio; ?></td>

                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $venta->id; ?>">

                            <!-- <input type="botton" class="boton-verde-block" value="Descargar PDF"> -->
                            <button type="button" onclick="generarPDFP(this)" class="boton-verde-block"> Descargar PDF</button>

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <table class="propiedad">
        <thead>
            <tr>

                <th>Cliente</th>
                <th>Vendedor</th>

                <th>Servicio</th>
                <th>Fecha</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($ventasS as $ventas) : ?>
                <tr>

                    <td class="nombreCliente"><?php echo $ventas->cliente->nombre; ?></td>
                    <td class="nombreVendedor"><?php echo $ventas->vendedor->nombre; ?></td>

                    <td class="mbps">
                        <?php

                        echo $ventas->servicio->mbps . 'mbps';

                        ?>
                    </td>
                    <td class="fechaVenta"><?php echo $ventas->fecha; ?></td>
                    <td class="precio" style="display: none;"><?php echo $ventas->servicio->precio; ?></td>

                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id_s" value=" <?php echo $ventas->id; ?>">

                            <!-- <input type="submit" class="boton-verde-block" value="Descargar PDF"> -->
                            <button type="button" onclick="generarPDF(this)" class="boton-verde-block"> Descargar PDF</button>
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