<h2><?php echo $titulo; ?></h2>
<div class="productos__contenedor" id="productos">
        
            <?php $subtotal = 0; foreach($carritos as $carrito){  ?>
            <div class="productos__contenido">
                   
                    <div class="contenido-productos">
                    <img class="productos__imagen" loading="lazy" src="img/productos/<?php echo $carrito->producto->imagen . ".png"; ?>" alt="producto">
                        <p><?php echo $carrito->producto->nombre; ?></p>
                        <p>Precio Neto:<?php echo $carrito->producto->precio; ?></p>
                        <p>Cantidad: <?php echo $carrito->cantidad; ?></p>
                        <?php $subtotal += $carrito->producto->precio*$carrito->cantidad;  ?>
                    </div><!--.contenido-producto-->
            </div><!--producto-->
            <?php } ?>
            

</div> <!--.contenedor-productos-->
<p>total sin impuestos: $<?php echo $subtotal; ?></p>
<p>total con impuestos: $<?php echo $total = $subtotal*1.16+5; ?></p>

            
            <form method="POST" action="/pedidos/pagar"  >
                
                <button  type="submit" class="formulario__submit">    
                        Pagar  Total: $<?php echo $total; ?>
                </button>
            </form>

