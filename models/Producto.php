<?php 

namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre','descripcion', 'precio','imagen', 'stock','categoria_id'];

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $imagen;
    public $stock;
    public $categoria_id;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->stock = $args['stock'] ?? '';
        $this->categoria_id = $args['categoria_id'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'La Descripcion es Obligatorio';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'El Precio es Obligatorio';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La Imagen es Obligatoria';
        }

        if(!$this->stock) {
            self::$alertas['error'][] = 'Agrega el stock';
        }
        if(!$this->categoria_id) {
            self::$alertas['error'][] = 'La categoria es obligatoria';
        }

    
        return self::$alertas;
    }

}