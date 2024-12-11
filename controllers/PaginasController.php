<?php

namespace Controllers;

use Classes\Paypal;
use Model\Carrito;
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

    public static function agregarCarrito(Router $router){
        
    }

    public static function carrito(Router $router){
        $total = $_SESSION['id'] ?? -1;
        $carritos = Carrito::whereM('idCliente',$total);
        //debuguear($carritos);
        foreach($carritos as $carrito) {
            $carrito->producto = Producto::find($carrito->idProducto);
        }
        //debuguear($carritos);
        $router->render('paginas/carrito', [
            'titulo' => 'Carrito de compras',
            'carritos' => $carritos
        ]);
    }


    public static function pagar(Router $router){
        if(!isset($_SESSION['orden'])) {
            print_r("esta extablecida");
            $_SESSION['orden'] = new Paypal;
        }else{
            print_r(" no esta extablecida");
            $orden = $_SESSION['orden'];
        }

        

        if(!$orden->accessToken){
            $orden->ObtenerToken();
        }

        

        if(!$orden->orderId){
            $orden->CreateOrder();
        }

        $urlPago = $orden->linkPago;
        //debuguear($urlPago);
        header('Location: '.$urlPago);
        exit();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            
        }


        
        
        
    }

    public static function completado(Router $router){
        if(!isset($_SESSION['orden'])) {
            $_SESSION['orden'] = new Paypal;
        }else{
            $orden = $_SESSION['orden'];
        }
        
        print_r($orden->ShowOrder());
        return;
        $resultado = $orden->CheckOrder();

        if($resultado["status"] === "APPROVED"){
            $ticket = $resultado["purchase_units"][0]["payee"]["merchant_id"];
            debuguear($ticket);
        }

    }
}