<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '26944562b40e2f';
        $mail->Password = '56d96427631605';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p>Hola <strong>' . $this->nombre . '</strong> has creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace</p>';
        $contenido .= '<p> Presiona aquí: <a href="http://localhost:3000/confirmar-cuenta?token=' . $this->token . '"> Confirmar cuenta</a></p>';
        $contenido .= '<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }

    public function enviarInstrucciones() { 
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '26944562b40e2f';
        $mail->Password = '56d96427631605';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu password';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p>Hola <strong>' . $this->nombre . '</strong> has solicitado cambiar de contraseña</p>';
        $contenido .= '<p> Presiona aquí: <a href="http://localhost:3000/recuperar?token=' . $this->token . '"> Cambiar de contraseña</a></p>';
        $contenido .= '<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        // Enviar el mail
        $mail->send();
    }
}