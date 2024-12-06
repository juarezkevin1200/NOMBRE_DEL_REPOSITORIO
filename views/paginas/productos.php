<main class="contenedor seccion">

        <h2><?php echo $titulo; ?></h2>

        <div class="productos__contenedor" id="productos">
            <?php foreach($productos as $producto){ ?>
            <div class="productos__contenido">
                
                    <img class="productos__imagen" loading="lazy" src="img/productos/<?php echo $producto->imagen . ".png"; ?>" alt="producto">

                    <div class="contenido-productos">
                        <h3><?php echo $producto->nombre; ?></h3>
                        <p class="precio">$<?php echo $producto->precio; ?></p>
                        <a href="/propiedad?id=<?php echo $producto->id; ?>">
                        Agregar al carrito
                        </a>
                    </div><!--.contenido-producto-->
            </div><!--producto-->
            <?php } ?>
        </div> <!--.contenedor-productos-->

</main>