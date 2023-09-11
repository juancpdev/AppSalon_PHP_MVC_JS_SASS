<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo-contenedor">
        <div class="campo">
            <input 
                type="name"
                id="nombre"
                placeholder="Nombre"
                name="nombre"
                value="<?php echo s($usuario->nombre) ?>"
            >
        </div>
        <div class="campo">
            <input 
                type="name"
                id="apellido"
                placeholder="Apellido"
                name="apellido"
                value="<?php echo s($usuario->apellido) ?>"
            >
        </div>
        <div class="campo">
            <input 
                type="number"
                id="telefono"
                placeholder="Telefono"
                name="telefono"
                value="<?php echo s($usuario->telefono) ?>"
            >
        </div>
        <div class="campo">
            <input 
                type="email"
                id="email"
                placeholder="Correo electronico"
                name="email"
                value="<?php echo s($usuario->email) ?>"
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

    <input class="btn-azul" type="submit" value="Crear Cuenta">
</form>

<div class="acciones">
    <p>¿Ya tienes una cuenta?<a href="/"> <strong>Inicia Sesión</strong></a></p>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>