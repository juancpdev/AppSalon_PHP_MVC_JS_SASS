<?php

namespace Controllers;

use Model\PerfilCita;
use MVC\Router;

class PerfilController {

    public static function index(Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        isAuth();

        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        $fechas = explode("-", $fecha);

        
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /400");
        }

        $idUser = $_SESSION['id'];


        $consulta = "SELECT usuarios.id as usuarioId, citas.id as citaId, citas.fecha, citas.hora, servicios.nombre as servicio, ";
        $consulta .= " servicios.precio FROM citas LEFT OUTER JOIN usuarios ON citas.usuarioId=usuarios.id ";
        $consulta .= " LEFT OUTER JOIN citasServicios ON citasServicios.citaId=citas.id LEFT OUTER JOIN ";
        $consulta .= " servicios ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE usuarioId = '{$idUser}' AND citas.fecha = '{$fecha}' ";

        $citas = PerfilCita::SQL($consulta);


        $router->render("perfil/index", [
            'nombre' => $_SESSION['nombre'],
            'apellido' => $_SESSION['apellido'],
            'email' => $_SESSION['email'],
            'telefono' => $_SESSION['telefono'],
            'id' => $_SESSION['id'],
            'citas' => $citas,
            "fecha" => $fecha
        ]);
    }

}