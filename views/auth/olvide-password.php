<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo-contenedor">
        <div class="campo">
            <input 
                type="email"
                id="email"
                placeholder="Correo electronico"
                name="email"
            >
        </div>
    </div>

    <input class="btn-azul" type="submit" value="Enviar instrucciónes">
</form>

<div class="acciones">
    <p>¿Aún no tienes una cuenta?<a href="/crear-cuenta"> <strong>Crear una</strong></a></p>
    <p>¿Ya tienes una cuenta?<a href="/"> <strong>Inicia Sesión</strong></a></p>
</div>
