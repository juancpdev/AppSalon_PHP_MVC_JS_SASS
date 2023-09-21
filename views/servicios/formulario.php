<div class="campo-contenedor">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input 
            type="text"
            id="nombre-servicio"
            name="nombre"
            placeholder="Nombre Servicio"
            value="<?php echo isset($_SESSION['servicio_creado']) ? '' : $servicio->nombre; ?>">

        <label for="precio">Precio:</label>
        <input 
            type="number"
            id="precio-servicio"
            name="precio"
            placeholder="Precio Servicio"
            value="<?php echo isset($_SESSION['servicio_creado']) ? '' : $servicio->precio; ?>">
    </div>
</div>