<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use Models\Administrator as Administrator;

class LoginController {

    public function Login($email) {
        
        if (isset($_SESSION["loginError"])) {
            unset($_SESSION["loginError"]);
        }
        
        $Students = new StudentDAO();
        $StudentsList = $Students->GetAll();

        if ($email == "admin@utn.com") {
            $administrator = new Administrator();
            $administrator->setEmail($email);

            $_SESSION["activeAdministrator"] = $administrator;
            
            require_once(VIEWS_PATH . "adminPanel.php");
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

}

?>