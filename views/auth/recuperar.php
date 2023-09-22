<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">A continuación escribe el nuevo password</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
    if($error) return;
?>

<form class="formulario" method="POST">
    <div class="campo-contenedor">
        <div class="campo">
            <input 
                type="password"
                id="password"
                placeholder="Nueva contraseña"
                name="password"
            >
        </div>
    </div>
    <div class="btn-contenedor">
        <input class="btn-azul" type="submit" value="Confirmar password">
    </div>
</form>

<div class="acciones">
    <p>¿Aún no tienes una cuenta?<a href="/crear-cuenta"> <strong>Crear una</strong></a></p>
    <p>¿Ya tienes una cuenta?<a href="/"> <strong>Inicia Sesión</strong></a></p>
</div>
