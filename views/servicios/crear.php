<?php include_once __DIR__ . "/../templates/barra.php" ?>

<h1 class="nombre-pagina">Panel de Aministración</h1>

<?php include_once __DIR__ . "/../templates/btn-admin.php" ?>



<div class="contenedor-buscar-cita">
    <h3>Crear Servicios</h3>
    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <form class="formulario" method="POST" action="/servicios/crear">
        <?php include_once __DIR__ . "/formulario.php" ?>
        <button type="button" class="btn-azul-chico" onclick="servicioCreado(event)">Guardar Servicio</button>
    </form>
</div>

<?php

$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";