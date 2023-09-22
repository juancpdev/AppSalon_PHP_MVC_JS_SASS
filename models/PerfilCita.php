<?php

namespace Model;

class PerfilCita extends ActiveRecord {
    protected static $tabla = "citas";
    protected static $columnasDB = ["usuarioId", "citaId", "fecha", "hora", "servicio", "precio"];
    
    public $usuarioId;
    public $citaId;
    public $fecha;
    public $hora;
    public $servicio;
    public $precio;

    public function __construct( $args = [])
    {
        $this->usuarioId = $args["usuarioId"] ?? null;
        $this->citaId = $args["citaId"] ?? null;
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
        $this->servicio = $args["servicio"] ?? "";
        $this->precio = $args["precio"] ?? "";
    }
}