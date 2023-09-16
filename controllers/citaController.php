<?php

namespace Controllers;

use MVC\Router;

class citaController {

    public static function index(Router $router) {

        session_start();

        isAuth();

        $router->render("cita/index", [
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'id' => $_SESSION['id']
        ]);
    }

}