<main class="pedidos">
    <h1 class="pedidos__titulo"><?php echo $titulo; ?></h1>

    <table class="pedidos__tabla">
        <thead class="pedidos__encabezado">
            <tr class="pedidos__fila pedidos__fila--encabezado">
                <th class="pedidos__celda pedidos__celda--encabezado">ID Pedido</th>
                <th class="pedidos__celda pedidos__celda--encabezado">Fecha</th>
                <th class="pedidos__celda pedidos__celda--encabezado">Total</th>
                <th class="pedidos__celda pedidos__celda--encabezado">Producto</th>
                <th class="pedidos__celda pedidos__celda--encabezado">Precio</th>
            </tr>
        </thead>
        <tbody class="pedidos__cuerpo">
            <?php foreach ($pedidos as $pedido): ?>
                <tr class="pedidos__fila pedidos__fila--<?php echo $pedido->rowClass; ?>">
                    <td class="pedidos__celda"><?php echo $pedido->ticket->id ?? 'N/A'; ?></td>
                    <td class="pedidos__celda"><?php echo $pedido->ticket->fecha ?? 'Sin fecha'; ?></td>
                    <td class="pedidos__celda">$<?php echo number_format($pedido->ticket->total ?? 0, 2); ?></td>
                    <td class="pedidos__celda"><?php echo $pedido->producto->nombre ?? 'Producto no encontrado'; ?></td>
                    <td class="pedidos__celda">$<?php echo number_format($pedido->producto->precio ?? 0, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
