<fieldset>
    <legend>Informacion del producto</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre producto" value="<?php echo $productos->nombre; ?>">
    <label for="descripcion">Descripcion:</label>
    <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del producto" value="<?php echo $productos->descripcion; ?>">

    <label for="stock">Cantidad:</label>
    <input type="text" name="stock" id="stock" placeholder="Stock" value="<?php echo $productos->stock; ?>">


    <label for="precio">Precio:</label>
    <input type="number" name="precio" id="precio" placeholder="Precio" value="<?php echo $productos->precio; ?>">


</fieldset>