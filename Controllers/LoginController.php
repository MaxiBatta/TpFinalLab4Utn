<?php

namespace Controllers;

use Models\Student as Student;
use Models\Administrator as Administrator;
use Models\Company as Company;
use Utils\Utils as Utils;
use DAO\StudentDAO as StudentDAO;
use DAO\CompanyDAO as CompanyDAO;

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
            $companyDAO = new CompanyDAO();
            $company = $companyDAO->GetCompanyByMail($email);

            if(empty($student) && empty ($company)){
                $_SESSION["loginError"] = 1;
                require_once(VIEWS_PATH . "index.php");
                exit;
            }

            if ($student) {
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
            
            if ($company){
            
            $activeCompany = new Company();
            
            $activeCompany->setCompanyId($company->getCompanyId());
            $activeCompany->setName($company->getName());
            $activeCompany->setYearFoundation($company->getYearFoundation());
            $activeCompany->setCity($company->getCity());
            $activeCompany->setDescription($company->getDescription());
            $activeCompany->setLogo($company->getLogo());
            $activeCompany->setEmail($company->getEmail());
            $activeCompany->setPhoneNumber($company->getPhoneNumber());
            $activeCompany->setActive($company->getActive());
            

            $_SESSION["activeCompany"] = $activeCompany;

            require_once(VIEWS_PATH . "company-panel.php");
            }
        }
    }
}

?>