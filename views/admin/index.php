<div class="app2">

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
                        >
                </div>
            </div>
            <?php echo $cita; ?>
        </form>
    </div>
</div>