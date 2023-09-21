<?php 
    $rutaActual = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $botones = [
        "/admin" => "Ver Citas",
        "/servicios" => "Ver Servicios",
        "/servicios/crear" => "Crear Servicios"
    ];


?>

<div class="contenedor-botones-admin">
    <?php
        foreach($botones as $ruta => $titulo) { ?>
            <a class="btn-azul-chico <?php echo ($rutaActual === $ruta) ? 'actual' : '' ?> " href="<?php echo $ruta;?>"><?php echo $titulo; ?></a>
    <?php
        } 
    ?>
</div>