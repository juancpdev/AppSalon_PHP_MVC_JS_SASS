<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    // LOGIN
    public static function login( Router $router ) {
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST" ) {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                // Comprobar que el usuario existe
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    // Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['telefono'] = $usuario->telefono;
                        $_SESSION['login'] = true;

                        // Redireccionamiento
                        if($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    } 
                } else {
                    Usuario::setAlerta('error', 'El usuario que ingresaste no está conectado a una cuenta');
                }
            } 
        }
        $alertas = Usuario::getAlertas();
        $router -> render("auth/login", [
            'alertas' => $alertas
        ]);
    }

    // LOGOUT
    public static function logout() {
        $_SESSION = [];
        header("Location: /");
    }

    // OLVIDE CONTRASEÑA
    public static function olvide( Router $router ) {
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                // Comprobar que el usuario existe
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    // Alerta de exito
                    Usuario::setAlerta('exito', 'Verifica tu email');

                    // Generar un token
                    $usuario->crearToken();

                    // Enviar el mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    $usuario->guardar();

                } else {
                    Usuario::setAlerta('error', 'El usuario que ingresaste no está conectado a una cuenta');
                }
            } 
        }
        $alertas = Usuario::getAlertas();
        $router -> render("auth/olvide-password", [
            'alertas' => $alertas
        ]);
    }

    // RECUPERAR PASSWORD
    public static function recuperar(Router $router ) {
        $alertas = [];
        $token = s($_GET["token"]);
        $usuario = Usuario::where('token', $token);
        $error = false;

        if(empty($usuario)) {
            // Mensaje de error
            Usuario::setAlerta('error', 'token no válido');
            $error = true;
        }
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();  

            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->passwordHash();
                $usuario->token = null;
                
                // Crear el usuario
                $resultado = $usuario->guardar();
                if($resultado) {
                    header('Location: /cita');
                }
                
            }
        }

        $alertas = Usuario::getAlertas();
        $router -> render("auth/recuperar", [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    
    // CREAR CUENTA
    public static function crear( Router $router ) {
        $usuario = new Usuario;

        // Alertas vacias
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST" ) {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();      
            
            // Revisar que alertas esté vacio
            if(empty($alertas)) {
                // Verifica que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    // Verificar si el usuario existe (msj de error)
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hash al password
                    $usuario->passwordHash();
                    
                    // Generar un token
                    $usuario->crearToken();

                    // Enviar el mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    // Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router -> render("auth/crear-cuenta", [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    // MENSAJE CONFIRMA TU CUENTA
    public static function mensaje(Router $router ) {

        $router -> render("auth/mensaje", [

        ]);
    }


    // CUENTA CONFIRMADA
    public static function confirmar(Router $router ) {
        $alertas = [];
        $token = s($_GET["token"]);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario) || $usuario->token === '') {
            // Mensaje de error
            Usuario::setAlerta('error', 'token no válido');
        } else {
            // Cambiar valor de la columna confirmado
            $usuario->confirmado = "1";
            // Eliminar token
            $usuario->token = null;
            // Guardar y actualizar
            $usuario->guardar();
            // Mensaje exito
            Usuario::setAlerta('exito', 'cuenta confirmada correctamente');
        }

        $alertas = Usuario::getAlertas();

        $router -> render("auth/confirmar-cuenta", [
            'alertas' => $alertas
        ]);
    }

}