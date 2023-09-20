<?php include_once __DIR__ . "/../templates/barra.php" ?>

<h1 class="nombre-pagina">Panel de Aministración</h1>

<div class="contenedor-buscar-cita">
    <h3>Bucar Cita</h3>
    <form class="formulario" method="POST">
        <div class="campo-contenedor">
            <div class="campo">
                <label for="fecha">Fecha:</label>
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

<div id="citas-admin">
    <ul class="citas">
    <?php 
    $idCita = 0;
        foreach($citas as $key => $cita) { 
            if($idCita !== $cita->id) {
                $precioTotal = 0;
    ?>
            <li class="citas-li">
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>Hora: <span><?php echo substr($cita->hora, 0, 5); ?> hs</span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?> </span></p>
                <p>Email: <span><?php echo $cita->email; ?> </span></p>
                <p>Telefono: <span><?php echo $cita->telefono; ?> </span></p>

                <h3>Servicios</h3>
    <?php 
    $idCita = $cita->id;
    } // End If ?>
                <p class="servicio"><span><?php echo $cita->servicio . ": $" . $cita->precio ?> </span></p>
    <?php 
        $precioTotal += $cita->precio;
        $actual = $cita->id;
        $proximo = $citas[$key + 1]->id ?? 0;


        if(esUltimo($actual, $proximo)) { ?>
            <p>Total: <span>$<?php echo $precioTotal; ?> </span></p>

            <form action="/api/eliminar" method="POST" id="formEliminar" >
                <input type="hidden" name="id" value="<?php echo $cita->id; ?>"> 
                <input type="submit" class="btn-rojo-chico" value="Eliminar" onclick="confirmDelete(event)"> 
            </form> 

    <?php   }
    ?>
                
    <?php  } // End Foreach ?>
        </li>
    </ul>
</div>

<?php

$script = "
    <script src='build/js/buscador.js'></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
";

