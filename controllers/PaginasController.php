<?php

namespace Controllers;

use Classes\Paypal;
use Model\Carrito;
use Model\Producto;
use Model\TicketProductos;
use Model\Tickets;
use MVC\Router;
use PDOException;

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

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', [
            'titulo' => 'Nosotros'
        ]);
    }

    public static function agregarOrden(){
        $paypal = new Paypal;
        $paypal->ObtenerToken(); // Genera el token de acceso
        $response = $paypal->CreateOrder(); // Crea la orden en PayPal

        $data = json_decode($response, true);

        if ($paypal->orderId && $paypal->linkPago) {
            echo json_encode([
                'success' => true,
                'linkPago' => $paypal->linkPago
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se pudo crear la orden'
            ]);
        }
    }

    public static function capturarOrden(Router $router){
        $paypal = new Paypal();
        $paypal->ObtenerToken(); // Obtén el token de acceso
        $paypal->orderId = $_GET['token']; // El token de PayPal (orderId) llega como parámetro en la URL

        $orderDetails = $paypal->CheckOrder();

        if (isset($orderDetails['status']) && $orderDetails['status'] === 'COMPLETED') {
            

                header('Location: /pedidos/completado');
                exit;

        } elseif ($orderDetails['status'] === 'APPROVED') {
            $response = $paypal->CaptureOrder();
            $data = json_decode($response, true);

            if (isset($data['status']) && $data['status'] === 'COMPLETED') {
                // Guarda en la base de datos
                $orderId = $paypal->orderId;
                $total = $orderDetails['purchase_units'][0]['amount']['value'];
                $status = $data['status'];
                $ticket = new Tickets;
                $ticket->sincronizar([
                    'order_id' => $orderId,
                    'total' => $total,
                    'status' => $status,
                    'idcliente' => $_SESSION['id']
                ]);

                $carritos = Carrito::whereM('idCliente',$_SESSION['id']);
               
                $resultado = $ticket->guardar();
                
                foreach($carritos as $carrito) {
                    $ticketProducto = new TicketProductos;
                    $ticketProducto->sincronizar([
                        'id_ticket' => $resultado["id"],
                        'id_productos' => $carrito->idProducto
                    ]);
                    $ticketProducto->guardar();
                } 
                
                
                foreach($carritos as $carrito) {
                    $carrito->eliminar();
                } 
                $_SESSION['idPedido'] = $orderId;
                header('Location: /pedidos/completado');
                exit;

            } else {
                echo "Error al capturar la orden: " . json_encode($data);
            }
            header('Location: /productos');
            exit;
        } else {
            echo "El estado de la orden no permite captura. Estado actual: " . $orderDetails['status'];
        }

    }

    public static function agregarCarrito(){
        
        header('Content-Type: application/json');
        // Decodificar la petición JSON
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar si el usuario está autenticado
        if (!is_auth()) {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            exit;
        }

        

        // Obtener los datos enviados
        $idProducto = $data['producto_id'] ?? null;
        $idCliente = $_SESSION['id'];

        // Validar los datos
        if (!$idProducto || !$idCliente) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
            exit;
        }

        // Guardar en la base de datos
        try {
            $carrito = new Carrito;
            $carrito->sincronizar(['idProducto' =>$idProducto,
            'idCliente' => $idCliente,
            'cantidad' => 1
            ]);
            $alertas = $carrito->validar();

            if(empty($alertas)) {
                $resultado = $carrito->guardar();
                if($resultado){
                    echo json_encode(['success' => true, 'message' => 'Producto añadido al carrito.']);
                    exit;
                }
            }

            echo json_encode(['success' => false, 'message' => 'Error al guardar en la base: ']);
            exit;

            
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $e->getMessage()]);
        }

    }

    public static function eliminar_carrito(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_auth()) {
                header('Location: /login');
            }
            
            $id = $_POST['id'];
            $carrito = Carrito::find($id);
            
            if($carrito->idCliente === $_SESSION['id']){
                $carrito->eliminar();
            }
            header('Location: /pedidos');
            
            
            
        }
    }
    public static function carrito(Router $router){
        $total = $_SESSION['id'] ?? -1;
        $carritos = Carrito::whereM('idCliente',$total);
        //debuguear($carritos);
        foreach($carritos as $carrito) {
            $carrito->producto = Producto::find($carrito->idProducto);
        }
        //debuguear($carritos);
        if(!is_auth()) {
            header('Location: /login');
        }else{
            $router->render('paginas/carrito', [
                'titulo' => 'Carrito de compras',
                'carritos' => $carritos
            ]);
        }
        
    }


    public static function pagar(Router $router){
        if(!isset($_SESSION['orden'])) {
            $_SESSION['orden'] = new Paypal;
        }else{
            $orden = $_SESSION['orden'];
        }
        debuguear($orden);
        

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
        
        $router->render('paginas/completado', [
            'titulo' => 'Ticket de compra',
            'idPedido' => $_SESSION['idPedido']
        ]);
        

    }
}