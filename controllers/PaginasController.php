<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;


class PaginasController {


    public static function index(Router $router) {
        

        $router->render('paginas/index', [
            'titulo' => 'Hola a todos'
        ]);
    }
    

    public static function error(Router $router) {

        $router->render('paginas/error', [
            'titulo' => 'Error 404 Página no encontrada :C '
        ]);
    }


    public static function direccion(Router $router){
        $router->render('paginas/direccion', [
            'titulo' => 'Dirección '
        ]);
    }

    public static function productos(Router $router){
        $productos = Producto::all();
        $router->render('paginas/productos', [
            'titulo' => 'Productos',
            'productos' => $productos
        ]);
    }
}