<?php include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Productos</h2>
    <a href="/crearPP" class="boton boton-verde">Nuevo Producto</a>
  
 <table class="propiedad">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
            


            </tr>
        </thead>
        <tbody>

            <?php foreach ($productos as $producto) : ?>
                <tr>
                    <td><?php echo $producto->nombre; ?></td>
                    <td><?php echo $producto->descripcion; ?></td>
                    <td><?php echo $producto->stock; ?></td>
                    <td>$<?php echo $producto->precio; ?></td>
                    


                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $producto->id; ?>">
                 

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/actualizarPP?id=<?php echo $producto->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>



</main>