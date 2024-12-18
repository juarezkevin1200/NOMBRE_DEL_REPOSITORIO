<?php

namespace Controllers;

use MVC\Router;

class DashboardController {

    public static function index(Router $router) {
        $nombreCompleto = $_SESSION['nombre'] . ' ' . $_SESSION['apellido'];
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'usuario' => $nombreCompleto
        ]);
    }

    

}