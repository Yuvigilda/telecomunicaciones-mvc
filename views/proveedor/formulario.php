<fieldset>
    <legend>Informacion general del Proveedor</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre proveedor" value="<?php echo $proveedores->nombre; ?>">

     <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" placeholder="Apellidos proveedor" value="<?php echo $proveedores->apellido; ?>">


     <label for="telefono"> Telefono:</label>
    <input  type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $proveedores->telefono; ?>">

   

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Correo" value="<?php echo $proveedores->email; ?>">


     <label for="empresa">Empresa:</label>
    <input type="text" name="empresa" id="empresa" placeholder="Empresa" value="<?php echo $proveedores->empresa; ?>">

      <label for="cuenta">Numero de cuenta:</label>
    <input type="text" name="no_cuenta" id="cuenta"  placeholder="No. Cuenta" value="<?php echo $proveedores->no_cuenta; ?>"> 


     

</fieldset>

