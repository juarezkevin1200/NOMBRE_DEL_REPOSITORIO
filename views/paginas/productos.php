<main class="contenedor seccion">

        <h2><?php echo $titulo; ?></h2>

        <div class="productos__contenedor" id="productos">
            <?php foreach($productos as $producto){ ?>
            <div class="productos__contenido">
                
                    <img class="productos__imagen" loading="lazy" src="img/productos/<?php echo $producto->imagen . ".png"; ?>" alt="producto">

                    <div class="contenido-productos">
                        <h3><?php echo $producto->nombre; ?></h3>
                        <p class="precio">$<?php echo $producto->precio; ?></p>
                        <!-- <form method="POST" action="/productos/agregar-carrito" >
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                <button  type="submit" class="boton">    
                                Agregar al carrito
                                </button>
                        </form> -->

                        <!-- <form method="POST">
                                <input type="hidden" name="producto_id" value="<?php echo $producto->id; ?>">
                                <button type="submit" class="boton" data-id="<?php echo $producto->id; ?>">Agregar al carrito</button>
                        </form> -->

                        <button class="boton" data-id="<?php echo $producto->id; ?>">
                        Añadir al Carrito
                        </button>
                        <div id="mensaje"></div>
                    </div><!--.contenido-producto-->
            </div><!--producto-->
            <?php } ?>
        </div> <!--.contenedor-productos-->

</main>