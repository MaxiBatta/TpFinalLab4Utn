<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use Models\Student as Student;

class RegisterController {
    
    public function ShowRegisterView($message = '') {
        $careerDAO = new CareerDAO();
        $careerLists = $careerDAO->getAll();
        require_once(VIEWS_PATH."student-registration.php");
    }
    
    public function RegisterStudent($careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active) {
        if ($_POST) {
            $studentDAO = new StudentDAO();
            $student = $studentDAO->checkStudentByMail($email);
            
            if (!$student) {
                require_once(VIEWS_PATH . "admin-panel.php");
                exit;
            }
            
            $studentToAdd = new Student();
            $studentToAdd->setCareerId($careerId);
            $studentToAdd->setFirstName($firstName);
            $studentToAdd->setLastName($lastName);
            $studentToAdd->setDni($dni);
            $studentToAdd->setFileNumber($fileNumber);
            $studentToAdd->setGender($gender);
            $studentToAdd->setBirthDate($birthDate);
            $studentToAdd->setEmail($email);
            $studentToAdd->setPhoneNumber($phoneNumber);
            $studentToAdd->setActive($active);

            $addedStudent = $studentDAO->AddMySql($studentToAdd);

            if (empty($addedStudent)) {
                $_SESSION["registerState"] = 0; //"Ocurrió un error al registrar el usuario"
            } else {
                $_SESSION["registerState"] = 1; //"El usuario ha sido registrado exitosamente"
            }

            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }
}
?>

