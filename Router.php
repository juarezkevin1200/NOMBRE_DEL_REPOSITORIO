<?php

namespace MVC;

use Model\Carrito;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        
        // Proteger Rutas...
        session_start();

        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin/dashboard','/propiedades/crear','/propiedades/actualizar'];
        $rutas_protegidas += ['/propiedades/eliminar','/vendedores/crear'];
        $rutas_protegidas += ['/vendedores/actualizar','/vendedores/eliminar'];

        $auth = $_SESSION['admin'] ?? '0';
        
        $currentUrl = strtok($_SERVER['REQUEST_URI'],'?') ?? '/';
        //debuguear($auth);
        $method = $_SERVER['REQUEST_METHOD'];

        //Proteger rutas
        if(in_array($currentUrl,$rutas_protegidas) && !$auth){
            header('Location: /');
        }

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }


        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); 
        
        include_once __DIR__ . "/views/$view.php";
        
        $contenido = ob_get_clean(); // Limpia el Buffer
        
        // Utilizar el Layout de acuerdo a la URL
        $url_actual = $_SERVER['REQUEST_URI'] ?? '/';
        //debuguear($$url_actual);
        if(str_contains($url_actual, '/admin')) {
            
            include_once __DIR__ . '/views/admin-layout.php';
        } else {
            $total = $_SESSION['id'] ?? -1;
            $total_carrito = Carrito::total('idCliente',$total);
            include_once __DIR__ . '/views/layout.php';
        }
    }
}