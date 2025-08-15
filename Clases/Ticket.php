<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Ticket
{
    public $cliente;
    public $producto;
    public $servicio;
    public $precio;
    public $fecha;


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
        $mail->Subject = 'Resumen de compra';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Haz realizado la compra de:  " . $producto . " " . $descripcion . "</strong></p>";

        $contenido .= "<p><strong>Monto de la compra: " . $precio . "</strong></p>";

        $contenido .= "<p><strong>Fecha y Hora " . $fecha . "</strong></p>";

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
        $mail->Subject = 'Resumen de compra';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Haz realizado la contratacion de:  " . $servicio  . "</strong>mbps de velocidad para navegar</p>";

        $contenido .= "<p><strong>Monto de la compra: " . $precio . "</strong></p>";

        $contenido .= "<p><strong>Fecha y Hora " . $fecha . "</strong></p>";

        $contenido .= "<p>Gracias por su compra</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }

    public function enviarTicketPago($cliente, $servicio, $precio, $fecha)
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
        $mail->Subject = 'Resumen de compra';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Haz realizado el pago del servicio:  " . $servicio  . "</strong>mbps de velocidad para navegar</p>";

        $contenido .= "<p><strong>Monto total: " . $precio . "</strong></p>";

        $contenido .= "<p><strong>Fecha y Hora " . $fecha . "</strong></p>";

        $contenido .= "<p>Gracias por su pago</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }


    public function notificacion($cliente)
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
        $mail->Subject = 'Notificacion';

        //setear el html

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $cliente . "</strong></p>";
        $contenido .= "<p><strong>Esta proxima tu fecha de pago recuerda realizarlo a tiempo en tienda o cajeros </strong></p>";
        $contenido .= "<p><strong>Si ya realizaste tu pago haz caso omiso a este mensaje  </strong></p>";

        $contenido .= "<p>Dudas o preguntas al 7571186253</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }
}
