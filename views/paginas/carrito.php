<h2><?php echo $titulo; ?></h2>
<?php if(count($carritos) === 0){ ?>
    <h2 class="">No Tienes productos en tu carrito</h2>
<?php }else{ ?>
<div class="carrito__contenedor" id="productos">
        
            <?php $subtotal = 0; foreach($carritos as $carrito){  ?>
            <div class="carrito__contenido">
                   
                    <img class="carrito__imagen" loading="lazy" src="img/productos/<?php echo $carrito->producto->imagen . ".png"; ?>" alt="producto">
                        <p><?php echo $carrito->producto->nombre; ?></p>
                        <p>Precio Neto:<?php echo $carrito->producto->precio; ?></p>
                        <p>Cantidad: <?php echo $carrito->cantidad; ?></p>
                        <form method="POST" action="/pedidos/eliminar" class="table__formulario">
                            <input type="hidden" name="id" value="<?php echo $carrito->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i> Eliminar
                                </button>
                        </form>
                        <?php $subtotal += $carrito->producto->precio*$carrito->cantidad;  ?>

            </div><!--producto-->
            <?php } ?>     
            
</div> <!--.contenedor-productos-->

<div class="carrito__totales">
    <p class="carrito__totales__titulo">Total sin impuestos:</p>
    <p class="carrito__totales__total">$<span><?php echo $subtotal; ?></span></p>
    <p class="carrito__totales__titulo">Total con impuestos:</p>
    <p class="carrito__totales__total">$<span><?php echo $total = $subtotal * 1.16 + 5; ?></span></p>
</div>



<?php $_SESSION['total'] = $total; ?>

    

    <button id="comprar-btn" class="formulario__submit">Pagar  Total: $<?php echo $total; ?></button>
    <div id="mensaje"></div>
 <?php } ?>




