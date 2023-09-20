<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/">
    <div class="campo-contenedor">
        <div class="campo">
            <input 
                type="email"
                id="email"
                placeholder="Correo electronico"
                name="email"
            >
        </div>

        <div class="campo">
            <input 
                type="password"
                id="password"
                placeholder="Contraseña"
                name="password"
            >
        </div>
    </div>

    <input class="btn-azul" type="submit" value="Iniciar Sesión">
</form>

<div class="acciones">
    <p>¿Aún no tienes una cuenta?<a href="/crear-cuenta"> <strong>Crear una</strong></a></p>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>
