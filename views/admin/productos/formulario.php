<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Datos del producto</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre Producto"
            value="<?php echo $producto->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea
            class="formulario__input"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción Evento"
            rows="8"
        ><?php echo $producto->descripcion; ?></textarea>
    </div>

    <div class="formulario__campo">
        <label for="precio" class="formulario__label">Precio</label>
        <input
            type="number"
            min="0"
            class="formulario__input"
            id="precio"
            name="precio"
            placeholder="Ej. 20"
            value="<?php echo $producto->precio; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        >
    </div>

    <?php if(isset($producto->imagen_actual)) { ?>
        <p class="formulario__texto">Imagen Actual:</p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.webp" type="image/webp">
                <source srcset="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" type="image/png">
                <img src="<?php echo $_ENV['HOST'] . '/img/productos/' . $producto->imagen; ?>.png" alt="Imagen Producto">
            </picture>
        </div>

    <?php } ?>



    <div class="formulario__campo">
        <label for="stock" class="formulario__label">Stock</label>
        <input
            type="number"
            min="1"
            class="formulario__input"
            id="stock"
            name="stock"
            placeholder="Ej. 20"
            value="<?php echo $producto->stock; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoría</label>
        <select
            class="formulario__select"
            id="categoria"
            name="categoria_id"
        >
            <option value="">- Seleccionar -</option>
            <?php foreach($categorias as $categoria) { ?>
                <option <?php echo ($producto->categoria_id === $categoria->id) ? 'selected' : '' ?> value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
            <?php } ?>
        </select>
    </div>  
</fieldset>


