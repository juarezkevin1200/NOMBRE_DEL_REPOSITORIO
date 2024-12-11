<?php 

namespace Model;

class Carrito extends ActiveRecord {
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'idProducto','idCliente', 'cantidad'];

    public $id;
    public $idProducto;
    public $idCliente;
    public $cantidad;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->idProducto = $args['idProducto'] ?? '';
        $this->idCliente = $args['idCliente'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';

    }

    
}
