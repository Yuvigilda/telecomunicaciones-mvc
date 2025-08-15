<fieldset>
    <legend>Informacion de Pago</legend>

    <div class="formulario__campo">
        <label for="clientes" class="formulario__label">Cliente:</label>
        <input type="text" class="formulario__input" id="clientes" placeholder="Buscar Cliente">
        <ul class="listado-clientes" id="listado-clientes"></ul>
        <input type="hidden" name="id_cliente" value="<?php echo $pagos->id_cliente; ?>">
    </div>
    <div class="formulario__campo">
        <label for="Vendedores" class="formulario__label">Vendedor:</label>
        <input type="text" class="formulario__input" id="vendedores" placeholder="Buscar vendedor">
        <ul class="listado-vendedores" id="listado-vendedores"></ul>
        <input type="hidden" name="id_proveedor" value="<?php echo $pagos->id_proveedor; ?>">
    </div>


    <?php  ?>
    <div class="formulario__campo">

        <label for="servicios" class="formulario_label">Servicio:</label>
        <select name="id_servicio" id="servicios">
            <option value="" selected>--Seleccione--</option>
            <?php foreach ($servicios as $servicio) { ?>
                <option <?php echo  $pagos->id === $pagos->id_servicio? 'selected' : ''; ?> value="<?php echo s($servicio->id) ?? 0; ?>"><?php echo $servicio->mbps . 'mbps'; ?></option>
            <?php } ?>
        </select>

</fieldset>