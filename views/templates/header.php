<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <!--  -->
            <?php if(is_auth()) { ?>
                <?php if(is_admin()) { ?>
                <a href="<?php echo is_admin() ? '/admin/dashboard' : '/productos'; ?>" class="header__enlace">Administrar</a>
                <?php } ?>
                <form method="POST" action="/logout" class="header__form">
                    <input type="submit" value="Cerrar Sesión" class="header__submit">
                </form>
            <?php } else { ?>
                <a href="/registro" class="header__enlace">Registro</a>
                <a href="/login" class="header__enlace">Iniciar Sesión</a>
            <?php } ?>
        </nav>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    MilkyWay Coffee
                </h1>
            </a>

            <p class="header__texto">Lunes a Viernes 9:00 am - 4:00 pm</p>
            <p class="header__texto">Sábado a Domingo 10:00 am - 2:00 pm</p>
            <p class="header__texto header__texto--modalidad">Pedidos en línea o en el local</p>

            <a href="/productos" class="header__boton">Ir a Compras </a>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">
                MilkyWay Coffee
            </h2>
        </a>
        
        <nav class="navegacion">
            <a href="/nosotros" class="navegacion__enlace <?php echo pagina_actual('/nosotros') ? 'navegacion__enlace--actual' : ''; ?>">Nosotros</a>
            <a href="/productos" class="navegacion__enlace <?php echo pagina_actual('/productos') ? 'navegacion__enlace--actual' : ''; ?>">Productos</a>
            <a href="/direccion" class="navegacion__enlace <?php echo pagina_actual('/direccion') ? 'navegacion__enlace--actual' : ''; ?>">Dirección</a>
            <a href="/pedidos" class="navegacion__enlace <?php echo pagina_actual('/pedidos') ? 'navegacion__enlace--actual' : ''; ?>"><img class="navegacion__enlace-carrito" src="/build/img/cart-shopping-solid.svg"> 
         <?php if(is_auth()){ echo $total_carrito;} ?></a>
            
        </nav>
    </div>
</div>