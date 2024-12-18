<?php 

namespace Model;

class Tickets extends ActiveRecord {
    protected static $tabla = 'tickets';
    protected static $columnasDB = ['id', 'order_id','total', 'status','idcliente'];

    public $id;
    public $order_id;
    public $total;
    public $status;
    public $idcliente;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->order_id = $args['order_id'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->status = $args['status'] ?? '';
        $this->idcliente = $args['idcliente'] ?? '';
    }

    
}