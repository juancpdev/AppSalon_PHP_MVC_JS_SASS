<?php include_once __DIR__ . "/../templates/barra.php" ?>

<h1 class="nombre-pagina">Panel de Aministración</h1>

<?php include_once __DIR__ . "/../templates/btn-admin.php" ?>

<div class="contenedor-buscar-cita">
    <h3>Servicios</h3>

    <ul class="servicios">
        <?php 
        foreach($servicios as $servicio) {
            ?>

                <li>
                    <div class="info-servicios">
                        <div class="servicios-p">
                            <p>Nombre: <span><?php echo $servicio->nombre  ?></span> </p>
                            <p>Precio: <span><?php echo $servicio->precio  ?></span> </p>
                        </div>
                    </div>
                    <div class="edit-servicios">
                        <div class="actualizar-servicios boton-servi">
                            <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                        <div class="eliminar-servicios boton-servi">
                            <form method="POST" action="/servicios/eliminar" id="formEliminarServicio-<?php echo $servicio->id; ?>">
                                <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                                <button type="submit" class="btn-rojo-chico" onclick="confirmDelete(event, 'formEliminarServicio-<?php echo $servicio->id; ?>')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </li>

        <?php } ?>
    </ul>
</div>

<?php

$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
