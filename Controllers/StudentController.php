<?php

namespace Controllers;

use Controllers\CareerController as CareerController;
use Controllers\JobOfferController as JobOfferController;
use Controllers\JobPositionController as JobPositionController;
use Controllers\ComapnyController as ComapnyController;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;
use DAO\JobOfferByStudentDAO as JobOfferByStudentDAO;
use Models\Student as Student;
use Utils\Utils as Utils;


class StudentController {

    private $studentDAO;
    private $careerController;
    private $jobOfferController;

    public function __construct() {
        $this->studentDAO = new StudentDAO();
        $this->careerController = new CareerController();
        ///$this->jobOfferController= new JobOfferController();
    }
    public function getAllInfo()
    {
        $studentList= $this->studentDAO->getAllMySql();
    }
    public function ShowStudentListBmView($message = '') {
        Utils::CheckAdmin();
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
        
        $careerDAO = new CareerDAO();
        $career =  $careerDAO->GetCareerByStudent($_SESSION["activeStudent"]->getCareerId());
        
        require_once(VIEWS_PATH . "student-personal-data.php");
    }

    public function ShowOffersCatalogueView($message = '') {
        require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
    }

    public function ShowModifyView($message = '') {
        $careerDAO = new CareerDAO();
        $careersList =  $careerDAO->GetAllMySql();
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
        if ($_REQUEST["dni"]) {
            $studentList = $this->studentDAO->SearchStudentMySql($_REQUEST["dni"]);
            
            if (!$studentList) {
                $_SESSION["found_students"] = 0;
            }
            else {
                $_SESSION["found_students"] = 1;
            }
            
            require_once(VIEWS_PATH . "student-list-bm.php");
        }
        else {
            $this->ShowStudentListBmView();
        }
    }
}

?>