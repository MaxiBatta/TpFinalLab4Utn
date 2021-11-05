<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use Models\Administrator as Administrator;
use Utils\Utils as Utils;

class LoginController {

    public function Login($email) {
        if (isset($_SESSION["loginError"])) {
            unset($_SESSION["loginError"]);
        }
        if (isset($_SESSION["notLogged"])) {
            unset($_SESSION["notLogged"]);
        }
        if (isset($_SESSION["existingMail"])) {
            unset($_SESSION["existingMail"]);
        }
        if (isset($_SESSION["registerState"])) {
            unset($_SESSION["registerState"]);
        }
        
        if ($email == "admin@utn.com") {
            $administrator = new Administrator();
            $administrator->setEmail($email);

            $_SESSION["activeAdministrator"] = $administrator;
            
            require_once(VIEWS_PATH . "admin-panel.php");
        } 
        else {
        
            $studentDAO = new StudentDAO();
            $student = $studentDAO->GetStudentByMail($email);

            if(empty($student) || !isset($student)){
                $_SESSION["loginError"] = 1;
                require_once(VIEWS_PATH . "index.php");
                exit;
            }

            $activeStudent = new Student();
            $activeStudent->setStudentId($student->getStudentId());
            $activeStudent->setCareerId($student->getCareerId());
            $activeStudent->setFirstName($student->getFirstName());
            $activeStudent->setLastName($student->getLastName());
            $activeStudent->setDni($student->getDni());
            $activeStudent->setFilenumber($student->getFileNumber());
            $activeStudent->setGender($student->getGender());
            $activeStudent->setBirthDate($student->getBirthDate());
            $activeStudent->setEmail($student->getEmail());
            $activeStudent->setPhoneNumber($student->getPhoneNumber());
            $activeStudent->setActive($student->getActive());

            $_SESSION["activeStudent"] = $activeStudent;

            require_once(VIEWS_PATH . "student-panel.php");
        }
    }
}

?>