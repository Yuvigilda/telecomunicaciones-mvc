<fieldset>
    <legend>Informacion de la venta</legend>
   
    <div class="formulario__campo">
        <label for="clientes" class="formulario__label">Cliente:</label>
        <input type="text" class="formulario__input" id="clientes" placeholder="Buscar Cliente">
        <ul class="listado-clientes" id="listado-clientes"></ul>
        <input type="hidden" name="id_cliente" value="<?php echo $ventas->id_cliente; ?>">
    </div>

    <div class="formulario__campo">
        <label for="Vendedores" class="formulario__label">Vendedor:</label>
        <input type="text" class="formulario__input" id="vendedores" placeholder="Buscar Vendedor">
        <ul class="listado-vendedores" id="listado-vendedores"></ul>
        <input type="hidden" name="id_proveedor" value="<?php echo $ventas->id_proveedor; ?>">
    </div>
    

    <div class="formulario__campo">
        <label for="prodcutos" class="formulario__label">Producto:</label>
        <input type="text" class="formulario__input" id="productos" placeholder="Buscar Productos">
        <ul class="listado-productos" id="listado-productos"></ul>
        <input type="hidden" name="id_producto" value="<?php echo $ventas->id_producto; ?>">
    </div>


</fieldset>