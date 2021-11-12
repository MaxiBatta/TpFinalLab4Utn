<?php

namespace Controllers;

use Controllers\CareerController as CareerController;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use Models\Student as Student;
use Utils\Utils as Utils;


class StudentController {

    private $studentDAO;

    public function __construct() {
        $this->studentDAO = new StudentDAO();
    }
    public function ShowStudentListBmView($message = '') {
        Utils::CheckBothSessions();
        $studentList = $this->studentDAO->GetAllMySql();
        require_once(VIEWS_PATH . "student-list-bm.php");
    }

    public function ShowLoginView($message = '') {
        Utils::CheckSession();
        require_once(VIEWS_PATH . "login.php");
    }

    public function ShowPanelView($message = '') {
        Utils::CheckSession();
        require_once(VIEWS_PATH . "student-panel.php");
    }

    public function ShowPersonalDataView($message = '') {
        Utils::CheckSession();
       
        require_once(VIEWS_PATH . "student-personal-data.php");
    }

    public function ShowCompaniesCatalogueView($message = '') {
        Utils::CheckSession();
        require_once(VIEWS_PATH . "company-list-catalogue.php");
    }

    public function ShowOffersCatalogueView($message = '') {
        require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
    }

    public function ShowModifyView($message = '') {
        $careerDAO = new CareerDAO();
        $careersList = $careerDAO->GetAllMySql(); 
        require_once(VIEWS_PATH . "student-modify.php");
    }

    public function Add($careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber) {
        //Utils::CheckSession();

        $student = new Student();

        // agregar set studentId autoincremental tomando el ultimo de la base
        $Student->setCareerId($careerId);
        $Student->setFirstName($firstName);
        $Student->setLastName($lastName);
        $student->setDni($dni);
        $student->setFileNumber($fileNumber);
        $student->setGender($gender);
        $student->setBirthDate($birthDate);
        $student->setEmail($email);
        $student->setPhoneNumber($phoneNumber);

        $this->studentDAO->AddMySql($student);

        $this->ShowLoginView();
    }

    public function UpdateStudent($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active) {   
        try
        {
            $student = new Student();
            $student->setStudentId($studentId);
            $student->setCareerId($careerId);
            $student->setFirstName($firstName);
            $student->setLastName($lastName);
            $student->setDni($dni);
            $student->setFilenumber($fileNumber);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            $student->setActive($active);
            
            $_SESSION["activeStudent"] = $student;
            
            $this->studentDAO->UpdateStudent($studentId, $student);
            
            if (isset($_SESSION["adminLogged"])) {
                require_once(VIEWS_PATH."admin-panel.php");
            }
            else {
                $this->ShowPanelView();
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function returnEmailById($id){
       $emailOfStudent=$this->studentDAO->findEmailById($id);
      
       return $emailOfStudent;
    }

    public function ShowFilteredStudentListView($message = '') {
        if (!$_REQUEST["dni"]) {
            require_once(VIEWS_PATH."student-list-bm.php");
            return;
        }
        else {
            $newStudentList = $this->studentDAO->SearchStudentMySql($_REQUEST["dni"]);
            if (!$newStudentList) {
                require_once(VIEWS_PATH."student-list-bm.php");
                return;
            }
            else {
                $_SESSION["found_students"] = $newStudentList;
                require_once(VIEWS_PATH."student-list-bm.php");
            }
        }
    }
}

?>