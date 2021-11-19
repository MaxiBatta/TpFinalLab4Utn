<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Models\JobOfferByStudent as JobOfferByStudent;
use DAO\StudentDAO as StudentDAO;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\JobOfferByStudentDAO as JobOfferByStudentDAO;
use DAO\CompanyDAO as CompanyDAO;

require './Utils/PHPMailer/src/Exception.php';
require './Utils/PHPMailer/src/PHPMailer.php';
require './Utils/PHPMailer/src/SMTP.php';

class MailController {

    public function __construct() {
        
    }

    public function SendEmail($studentEmail) {
        $usuario = 'test@offiweb.ar';
        $host = 'mail.offiweb.ar';
        $nombre = 'test';
        $clave = 'cb*V3M)6NKXm';
        $mail = new PHPMailer(true);
        try {
            ///Server settings
            /// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = $host;                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = $usuario;                     //SMTP username
            $mail->Password = $clave;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;

            //Recipients
            $mail->setFrom($usuario, $nombre);
            //Este es el destinatario
            $mail->addAddress($studentEmail);
            //Con copia
            ///$mail->addCC('cc@example.com');
            //Content
            $mail->isHTML(true);             //Esto le dice que el cuerpo es HTML
            $mail->Subject = 'Astunto de prueba';
            $mail->Body = 'Esto es un mail de <b>PRUEBAS!</b>';
            $mail->AltBody = 'Esto es lo que va a ver si lo ve en un mail antiguo';

            $mail->send();
            echo 'Mail enviado';
        } catch (Exception $e) {
            echo "No se pudo enviar. Error: {$mail->ErrorInfo}";
        }
    }

    public function SendMailEndJobOfferToStudents($postulation) {
        $jobOfferByStudentDAO = new JobOfferByStudentDAO();
        
        $jobOfferDAO = new JobOfferDAO();
        $jobOffer = $jobOfferDAO->GetJobOfferById($postulation->getJobOfferId());
        
        $studentDAO = new StudentDAO();
        $student = $studentDAO->GetStudentById($postulation->getStudentId());
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPosition = $jobPositionDAO->returnJobPositionByIdMySql($jobOffer->getJobPositionId());
        
        $companyDAO = new companyDAO();
        $company = $companyDAO->GetCompanyByIdMySql($jobOffer->getCompanyId());
        
        $mail = new PHPMailer(true);

        try {

            $tamaño = 2; //Tamaño de Pixel
            $level = 'Q'; //Precisión Baja
            $framSize = 3; //Tamaño en blanco
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'tpfinallaborato525@gmail.com';                // SMTP username
            $mail->Password = 'larousse356';                    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //Recipients
            $mail->setFrom('tpFinalLaboratorio@gmail.com', 'Administration');
            $mail->addAddress($student->getEmail(), $student->getFirstName());        // Name is optional
            // Attachments
            // foreach($listEntradas as $entrada) {
            //     $mail->addAttachment('Views/temp/'.$filename);         // Add attachments
            // }
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "La inscripcion para el puesto " . $jobPosition->getDescription() . " ha finalizado";
            $mail->Body = "¡Felicidades " . $student->getFirstName() ." tu postulación ha sido registrada exitosamente! En la brevedad " . $company->getName() . " se contactará contigo.";

            $mail->send();
            
            $jobOfferByStudentDAO->modifyMailSent($postulation->getJobOfferByStudentId(), 1); //Settea campo mailsent a 1;
        } catch (Exception $e) {
            $_SESSION["succefully-sent-mails"] = $mail->ErrorInfo;
        }
    }
    
    public function SendMailDeclineJobOffer($postulation, $mailcontent) {
        $jobOfferByStudentDAO = new JobOfferByStudentDAO();
        
        $jobOfferDAO = new JobOfferDAO();
        $jobOffer = $jobOfferDAO->GetJobOfferById($postulation->getJobOfferId());
        
        $studentDAO = new StudentDAO();
        $student = $studentDAO->GetStudentById($postulation->getStudentId());
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPosition = $jobPositionDAO->returnJobPositionByIdMySql($jobOffer->getJobPositionId());
        
        $companyDAO = new companyDAO();
        $company = $companyDAO->GetCompanyByIdMySql($jobOffer->getCompanyId());
        
        $mail = new PHPMailer(true);

        try {

            $tamaño = 2; //Tamaño de Pixel
            $level = 'Q'; //Precisión Baja
            $framSize = 3; //Tamaño en blanco
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'tpfinallaborato525@gmail.com';                // SMTP username
            $mail->Password = 'larousse356';                    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //Recipients
            $mail->setFrom('tpFinalLaboratorio@gmail.com', 'Administration');
            $mail->addAddress($student->getEmail(), $student->getFirstName());        // Name is optional
            // Attachments
            // foreach($listEntradas as $entrada) {
            //     $mail->addAttachment('Views/temp/'.$filename);         // Add attachments
            // }
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Se ha declinado tu postulacion del puesto " . $jobPosition->getDescription();
            $mail->Body = $mailcontent;

            $mail->send();
        } catch (Exception $e) {
            $_SESSION["succefully-sent-mails"] = $mail->ErrorInfo;
        }
    }

}

?>