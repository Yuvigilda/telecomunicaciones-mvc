<fieldset>
    <legend>Informacion general del Vendedor</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre Vendedor" value="<?php echo $vendedores->nombre; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Correo" value="<?php echo $vendedores->email; ?>">

    <label for="telefono"> Telefono:</label>
    <input type="telefono" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $vendedores->telefono; ?>">


    <label for="rfc">RFC::</label>
    <input type="text" name="rfc" id="rfc" placeholder="RFC" value="<?php echo $vendedores->rfc; ?>">


</fieldset>
<fieldset>
    <legend>Direccion del Vendedor</legend>

    <label for="municipio">Municipio:</label>
    <input type="text" name="municipio" id="municipio" placeholder="Municipio" value="<?php echo $vendedores->municipio; ?>">


    <label for="colonia">Colonia:</label>
    <input type="text" name="colonia" id="colonia" placeholder="Colonia" value="<?php echo $vendedores->colonia; ?>">

    <label for="calle">Calle:</label>
    <input type="text" name="calle" id="calle" placeholder="Calle" value="<?php echo $vendedores->calle; ?>">




</fieldset>