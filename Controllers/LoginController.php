<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use Models\Administrator as Administrator;
use Utils\Utils as Utils;

class LoginController {

    public function Login2($email) {
        
        if (isset($_SESSION["loginError"])) {
            unset($_SESSION["loginError"]);
        }
        if (isset($_SESSION["notLogged"])) {
            unset($_SESSION["notLogged"]);
        }
        
        $Students = new StudentDAO();
        $StudentsList = $Students->GetAll();

        if ($email == "admin@utn.com") {
            $administrator = new Administrator();
            $administrator->setEmail($email);

            $_SESSION["activeAdministrator"] = $administrator;
            
            Utils::CheckAdmin();
            
            require_once(VIEWS_PATH . "admin-panel.php");
        } else {
            $existingMail = 0;
            foreach ($StudentsList as $key => $value) {
                if ($email == $value->getEmail()) {
                    $existingMail = 1;
                    
                    $student = new Student();
                    $student->setFirstName($value->getFirstName());
                    $student->setLastName($value->getLastName());
                    $student->setStudentId($value->getStudentId());
                    $student->setCareerId($value->getCareerId());
                    $student->setDni($value->getDni());
                    $student->setFilenumber($value->getFileNumber());
                    $student->setGender($value->getGender());
                    $student->setBirthDate($value->getBirthDate());
                    $student->setEmail($value->getEmail());
                    $student->setPhoneNumber($value->getPhoneNumber());
                    
                    $_SESSION["activeStudent"] = $student;
                    
                    Utils::CheckSession();
                    
                    require_once(VIEWS_PATH . "student-panel.php");
                }
            }
            if (!$existingMail) {
                $_SESSION["loginError"] = 1;
                require_once(VIEWS_PATH . "index.php");
            }
        }
        /* else if($email == "admin@utn.com"){

          }
          else{
          echo "<script> if(confirm('Los datos ingresados son invalidos.'));";
          echo "window.location = 'index.php';</script>";
          }
          } */
    }
    
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