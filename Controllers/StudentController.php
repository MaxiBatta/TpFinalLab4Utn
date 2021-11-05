<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;
use Utils\Utils as Utils;

class StudentController {

    private $studentDAO;

    public function __construct() {
        $this->studentDAO = new StudentDAO();
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
        Utils::CheckSession();
        require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
    }

    public function ShowModifyView($message = '') {
        Utils::CheckSession();
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

    public function UpdateStudent2($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active) {

            $this->studentDAO->UpdateStudent($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active);

            $this->ShowPanelView();
    }
    
    public function UpdateStudent($studentId, $careerId, $firstName, $lastName, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber, $active) {   
        try
        {
            $student = new Student();
            $student->setStudentId($studentId);
            
            $foundStudent = $this->studentDAO->GetStudentById($studentId);
            
            $student->setCareerId($careerId);
            
            $firstName ? $student->setFirstName($firstName) : $student->setFirstName($foundStudent->getFirstName());
            $lastName ? $student->setLastName($lastName) : $student->setLastName($foundStudent->getLastName());
            $dni ? $student->setDni($dni) : $student->setDni($foundStudent->getDni());
            $fileNumber ? $student->setFilenumber($fileNumber) : $student->setFilenumber($foundStudent->getFilenumber());
            $gender ? $student->setGender($gender) : $student->setGender($foundStudent->getGender());
            $birthDate ? $student->setBirthDate($birthDate) : $student->setBirthDate($foundStudent->getBirthDate());
            $email ? $student->setEmail($email) : $student->setEmail($foundStudent->getEmail());
            $phoneNumber ? $student->setPhoneNumber($phoneNumber) : $student->setPhoneNumber($foundStudent->getPhoneNumber());
            $active ? $student->setActive($active) : $student->setActive($foundStudent->getActive());
            
            $this->studentDAO->UpdateStudent($studentId, $student);

            $this->ShowPanelView();
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}

?>