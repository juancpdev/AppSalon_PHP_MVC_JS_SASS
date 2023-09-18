<div class="app2">
    
    <?php include_once __DIR__ . "/../templates/barra.php" ?>

    <h1 class="nombre-pagina">Crear Nueva Cita</h1>
    <p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Info Citas</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion mostrar">
        <h2 id="nombre-pagina">Servicios</h2>
        <p class="text-center">Elige tus servicios y coloca tus datos</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Citas</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        <form class="formulario" method="POST">
            <div class="campo-contenedor">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input 
                        type="name" 
                        id="nombre" 
                        placeholder="Nombre" 
                        name="nombre" 
                        value="<?php echo $nombre . " " . $apellido ?>"
                        disabled
                        >
                </div>
                <div class="campo">
                    <label for="nombre">Fecha:</label>
                    <input 
                        type="date"
                        id="fecha"
                        min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>"
                        >
                </div>
                <div class="campo">
                    <label for="nombre">Hora:</label>
                    <input 
                        type="time"
                        id="hora">
                </div>
                <input type="hidden" id="id" value="<?php echo $id ?>">

            </div>
        </form>
    </div>
    
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button 
            type="button" 
            class="btn-azul-chico" 
            id="anterior"
            >
            &laquo; Anterior
        </button>
        <button 
            type="button" 
            class="btn-azul-chico" 
            id="siguiente"
            >
            Siguiente &raquo;
        </button>
    </div>
</div>

<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/app.js'></script>
        <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
    ";
?>