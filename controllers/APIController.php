<?php

namespace Controllers;

use Model\Producto;

class APIController{
    public static function index(){
        $productos = Producto::all();
        echo json_encode($productos);
    }

    public static function guardar(){
        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $citaId = $resultado['id'];
        //Almacena la cita y el servicio
        $idServicios = explode(",",$_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $citaId,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //Retonarmos una respuesta
        $respuesta =[
            'resultado' => $resultado
        ];

        echo json_encode($resultado);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}