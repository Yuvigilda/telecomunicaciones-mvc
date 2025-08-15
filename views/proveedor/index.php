<?php include_once __DIR__ . '/../templates/barra.php';

?>

<main class="contenedor seccion">



    <h2>Administrador de Proveedores</h2>
    <a href="/crearP" class="boton boton-verde">Nuevo Proveedor</a>
    <table class="propiedad">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Emial</th>
                <th>Empresa</th>
              
                <th>No.Cuenta</th>
                <th>Telefono</th>


            </tr>
        </thead>
        <tbody>

            <?php foreach ($proveedores as $proveedor) : ?>
                <tr>
                    <td><?php echo $proveedor->nombre; ?></td>
                    <td><?php echo $proveedor->apellido; ?></td>
                    <td><?php echo $proveedor->email; ?></td>
                    <td><?php echo $proveedor->empresa; ?></td>
                   
                    <td><?php echo $proveedor->no_cuenta; ?></td>
                    <td><?php echo $proveedor->telefono; ?></td>


                    <td>
                        <form action="" method="POST" class="w'100">
                            <input type="hidden" name="id" value=" <?php echo $proveedor->id; ?>">
                           

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/actualizarP?id=<?php echo $proveedor->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>




</main>