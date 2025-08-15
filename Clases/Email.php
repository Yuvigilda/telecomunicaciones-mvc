<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;
    public $cliente;
    public $producto;
    public $servico;
    public $precio;
    public $fecha;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        //crear el obj de email

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'EMAIL_HOST';
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@telecomunicaciones.com');
        $mail->addAddress('cuentas@telecomunicaciones.com', 'Telecomunicaciones.com');
        $mail->Subject = 'Confirma tu cuenta';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>has creado tu cuenta en Telecomunicaciones.com
        solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] ."/confirmar-cuenta?token=" . $this->token .  "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta puedes igmorar el mensaje</p>";
        $contenido .= "</html>";


        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }

    public function enviarInstrucciones()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'EMAIL_HOST';
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@telecomunicaciones.com');
        $mail->addAddress('cuentas@telecomunicaciones.com', 'Telecomunicaciones.com');
        $mail->Subject = 'Restalece tu password';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>has solicitado restablecer tu password
        sigue el siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Reestablecer password </a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }

    public function enviarTicketProducto($cliente, $producto, $descripcion, $precio, $fecha)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'EMAIL_HOST';
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@telecomunicaciones.com');
        $mail->addAddress('cuentas@telecomunicaciones.com', 'Telecomunicaciones.com');
        $mail->Subject = 'Restalece tu password';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Haz realizado la compra de:  " . $producto . " " . $descripcion . "</strong></p>";

        $contenido .= "<p><strong>Monto de la compra: " . $precio . "</strong></p>";

        $contenido .= "<p><strong>Fecha y Hora " . $fecha . "</strong></p>";

        $contenido .= "<p>Presiona aqui para descargar tu recibo: <a href='" . $_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Reestablecer password </a></p>";
        $contenido .= "<p>Gracias por su compra</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }

    public function enviarTicketServicio($cliente, $servicio, $precio, $fecha)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'EMAIL_HOST';
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->setFrom('cuentas@telecomunicaciones.com');
        $mail->addAddress('cuentas@telecomunicaciones.com', 'Telecomunicaciones.com');
        $mail->Subject = 'Restalece tu password';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Haz realizado la contratacion de:  " . $servicio  . "</strong>mbps de velocidad para navegar</p>";

        $contenido .= "<p><strong>Monto de la compra: " . $precio . "</strong></p>";

        $contenido .= "<p><strong>Fecha y Hora " . $fecha . "</strong></p>";

        $contenido .= "<p>Presiona aqui para descargar tu recibo: <a href='" . $_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Reestablecer password </a></p>";
        $contenido .= "<p>Gracias por su compra</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }
}
