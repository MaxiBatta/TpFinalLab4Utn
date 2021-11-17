<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './Utils/PHPMailer/src/Exception.php';
require './Utils/PHPMailer/src/PHPMailer.php';
require './Utils/PHPMailer/src/SMTP.php';


class MailController
    {

        public function __construct()
        {
            
        }
        public function SendEmail($studentEmail){
        $usuario = 'test@offiweb.ar';
        $host = 'mail.offiweb.ar';
        $nombre = 'test';
        $clave = 'cb*V3M)6NKXm';
        $mail = new PHPMailer(true);
        try {
            ///Server settings
            /// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $usuario;                     //SMTP username
            $mail->Password   = $clave;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    
        
            //Recipients
            $mail->setFrom($usuario, $nombre);
        //Este es el destinatario
            $mail->addAddress($studentEmail);     
        //Con copia
            ///$mail->addCC('cc@example.com');
            
            //Content
            $mail->isHTML(true);             //Esto le dice que el cuerpo es HTML
            $mail->Subject = 'Astunto de prueba';
            $mail->Body    = 'Esto es un mail de <b>PRUEBAS!</b>';
            $mail->AltBody = 'Esto es lo que va a ver si lo ve en un mail antiguo';
        
            $mail->send();
            echo 'Mail enviado';
        } catch (Exception $e) {
            echo "No se pudo enviar. Error: {$mail->ErrorInfo}";
        }
        }
    }
?>