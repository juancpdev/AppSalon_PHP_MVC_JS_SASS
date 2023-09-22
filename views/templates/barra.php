<div class="contenedor-principal-usuario">
    <div class="usuario-data">
        <i class="fa-solid fa-user"></i>
        <p>Hola, <?php echo $nombre ?></p>
    </div>
    <div class="acciones-boton">
        <?php if (!isset($_SESSION['admin'])) { ?>
            <a href="/perfil" class="btn-azul-chico">Mi Perfil</a>
        <?php } ?>
        <a href="/logout" class="btn-rojo-chico">Cerrar Sesión</a>
    </div>
</div>