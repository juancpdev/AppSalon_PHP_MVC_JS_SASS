<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {
    // INDEX
    public static function index( Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }        
        isAdmin();

        $servicios = Servicio::all();

        $router->render("servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        ]);
    }

    // CREAR
    public static function crear( Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }        
        isAdmin();
        
        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();

                header('Location: /servicios/crear');
                exit;
            }
        }
        $router->render("servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    // ACTUALIZAR
    public static function actualizar( Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }        
        isAdmin();

        if(!is_numeric($_GET["id"])) return;
        $servicio = Servicio::find($_GET["id"]);
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->actualizar();
                header('Location: /servicios');
            }
        }
        $router->render("servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    // ELIMINAR
    public static function eliminar( ) {
        session_start();
        if(!isAdmin()) {
            header('Location: /');
        }

        if($_SERVER["REQUEST_METHOD"] === "POST") { 
            $id = $_POST["id"];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header( 'Location: /servicios');
        }

    } 
}