<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Categoria;
use Model\Usuario;

class CLientesController {

    public static function index(Router $router) {
        if(!is_admin()) {
            header('Location: /login');
        }
        
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/clientes?page=1');
        }
        $registros_por_pagina = 5;
        $total = Producto::total();
        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if($paginacion->total_paginas() < $pagina_actual) {
            header('Location: /admin/clientes?page=1');
        }

        $clientes = Usuario::paginar($registros_por_pagina, $paginacion->offset());

        

        $router->render('admin/clientes/index', [
            'titulo' => 'Productos',
            'clientes' => $clientes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

}