<?php include_once __DIR__ . "/../templates/barra.php" ?>

<h1>Mi perfil</h1>

<div class="btn-inicio">
    <a href="/cita" class="btn-azul"><i class="fa-solid fa-house"></i>Inicio</a>
</div>

<h3>Mis datos</h3>

<div class="campo-contenedor">
    <div class="campo">
        <label for="nombre">Nombre y Apellido</label>
        <input 
            type="text" 
            id="nombre" 
            name="nombre" 
            value="<?php echo $nombre . " " . $apellido ?>"
            disabled
            >
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="text" 
            id="email" 
            name="email" 
            value="<?php echo $email ?>"
            disabled
            >
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="number" 
            id="telefono" 
            name="telefono" 
            value="<?php echo $telefono ?>"
            disabled
            >
    </div>
    <input type="hidden" id="id" value="<?php echo $id ?>">
</div>

<div class="contenedor-buscar-cita">
    <h3>Bucar Cita por fecha</h3>
    <form class="formulario" method="POST">
        <div class="campo-contenedor">
            <div class="campo">
                <input 
                    type="date"
                    id="fecha"
                    name="fecha"
                    value="<?php echo $fecha; ?>"
                    >
            </div>
        </div>
    </form>
</div>

<?php
    if(count($citas)  === 0) { ?>
    <h3>No Hay Citas Disponibles</h3>    
<?php    
    }
?>

<ul class="citas">
    <?php 
        $idCita = 0;
            foreach($citas as $key => $cita) { 
                if($idCita !== $cita->citaId) {
                    $precioTotal = 0;
    ?>
            <li>
                <p class="id-cita">Cita <?php echo $cita->citaId; ?></p>
                <p>Hora: <span><?php echo substr($cita->hora, 0, 5); ?> hs</span></p>
                <h3>Servicios</h3>
    
    <?php 
    $idCita = $cita->citaId;
} // End If ?>
    <p class="servicio"><span><?php echo $cita->servicio . ": $" . $cita->precio ?> </span></p>
<?php 
$precioTotal += $cita->precio;
$actual = $cita->citaId;
$proximo = $citas[$key + 1]->citaId ?? 0;


if(esUltimo($actual, $proximo)) { ?>
    <p>Total: <span>$<?php echo $precioTotal; ?> </span></p>

<form action="/api/eliminar" method="POST" id="formEliminarCita" >
    <input type="hidden" name="id" value="<?php echo $cita->citaId; ?>"> 
    <input type="submit" class="btn-rojo-chico" value="Eliminar" onclick="confirmDelete(event, 'formEliminarCita')"> 
</form> 

<?php   }
?>

<?php  } // End Foreach ?>
</li>
</ul>


<?php

$script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/buscador.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
