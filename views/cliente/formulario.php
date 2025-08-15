<fieldset>
    <legend>Informacion general del cliente</legend>
    
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre cliente" value="<?php echo $clientes->nombre; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Correo" value="<?php echo $clientes->email; ?>">
    
    <label for="telefono"> Telefono:</label>
    <input  type="telefono" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $clientes->telefono; ?>">

   
    <label for="rfc">RFC::</label>
     <input  type="text" name="rfc" id="rfc" placeholder="RFC" value="<?php echo $clientes->rfc; ?>">
    

</fieldset>
<fieldset>
     <label for="municipio">Municipio:</label>
    <input type="text" name="municipio" id="municipio"  placeholder="Municipio" value="<?php echo $clientes->municipio; ?>"> 
    
    <legend>Direccion del cliente</legend>
    <label for="localidad">Localidad:</label>
    <input type="text" name="localidad" id="localidad"  placeholder="localidad" value="<?php echo $clientes->localidad; ?>"> 

    <label for="colonia">Colonia:</label>
    <input type="text" name="colonia" id="colonia"  placeholder="Colonia" value="<?php echo $clientes->colonia; ?>"> 

    <label for="calle">Calle:</label>
    <input type="text" name="calle" id="calle"  placeholder="Calle" value="<?php echo $clientes->calle; ?>"> 

    
   
    
</fieldset>
