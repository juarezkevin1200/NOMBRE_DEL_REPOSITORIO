<?php 

namespace Model;

class TicketProductos extends ActiveRecord {
    protected static $tabla = 'ticket_productos';
    protected static $columnasDB = ['id', 'id_ticket','id_productos'];

    public $id;
    public $id_ticket;
    public $id_productos;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_ticket = $args['id_ticket'] ?? '';
        $this->id_productos = $args['id_productos'] ?? '';
    }

    
}