<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\CareerDAO as CareerDAO;
use Models\Student as Student;
use Models\Company as Company;
use Utils\Utils as Utils;

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

    public function RegisterCompany( $name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber, $active) {
        $companyDAO= new CompanyDAO();
        $validate = Utils :: validateFormCompany($name, $city, $phoneNumber);
        $validateName = $companyDAO->ValidateCompanyNameMySql($name);
        
        if ($_POST) {
            $companyDAO = new CompanyDAO();
            $company = $companyDAO->checkCompanyByMail($email);
            
            if (!$company) {
                require_once(VIEWS_PATH . "admin-panel.php");
                exit;
            }
            
        if ($validateName) {
                if ($validate) {
            $companyToAdd = new Company();
            
            $companyToAdd->setName($name);
            $companyToAdd->setYearFoundation($yearFoundation);
            $companyToAdd->setCity($city);
            $companyToAdd->setDescription($description);
            $companyToAdd->setLogo($logo);
            $companyToAdd->setEmail($email);
            $companyToAdd->setPhoneNumber($phoneNumber);
            $companyToAdd->setActive($active);

            $addedCompany = $companyDAO->AddMySql($companyToAdd);
                                } else {
            $_SESSION ["validateError"] = 1;
            require_once(VIEWS_PATH . "index.php");
                             }
                          } else {
            $_SESSION ["validateError"] = 2;
            require_once(VIEWS_PATH . "index.php");
                            }
            $_SESSION ["validateError"] = 0;

            if (empty($addedCompany)) {
                $_SESSION["registerState"] = 0; //"Ocurrió un error al registrar el usuario"
            } else {
                $_SESSION["registerState"] = 1; //"El usuario ha sido registrado exitosamente"
            }

            require_once(VIEWS_PATH . "index.php");
        }
    }
    public function ShowCompanyRegisterView($message = '')
        {
            require_once(VIEWS_PATH."company-registration.php");
        }
}
?>

