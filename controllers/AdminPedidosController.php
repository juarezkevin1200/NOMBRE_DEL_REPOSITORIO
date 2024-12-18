<?php

namespace Controllers;

use Model\Producto;
use Model\TicketProductos;
use Model\Tickets;
use MVC\Router;

class AdminPedidosController {

    public static function index(Router $router) {
        $pedidos = TicketProductos::all();
        $ticketClass = [];
        $isOdd = true;
    
        foreach ($pedidos as $pedido) {
            $pedido->ticket = Tickets::find($pedido->id_ticket);
            $pedido->producto = Producto::find($pedido->id_productos);
    
            // Alternar entre "odd" y "even" para cada id_ticket
            if (!isset($ticketClass[$pedido->id_ticket])) {
                $ticketClass[$pedido->id_ticket] = $isOdd ? "odd" : "even";
                $isOdd = !$isOdd;
            }
            $pedido->rowClass = $ticketClass[$pedido->id_ticket];
        }
    
        $router->render('admin/pedidos/index', [
            'titulo' => 'Lista de Pedidos',
            'pedidos' => $pedidos
        ]);
    }
    

}