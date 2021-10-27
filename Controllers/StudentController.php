<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use Utils\Utils as Utils;
    
    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }
   
        public function ShowLoginView($message = '')
        {
            Utils::CheckSession();
            require_once(VIEWS_PATH."login.php");
        }
        
        public function ShowPanelView($message = '')
        {
            Utils::CheckSession();
            require_once(VIEWS_PATH."student-panel.php");
        }
        
        public function ShowPersonalDataView($message = '')
        {
            Utils::CheckSession();
            require_once(VIEWS_PATH."student-personal-data.php");
        }
        
        public function ShowCompaniesCatalogueView($message = '')
        {
            Utils::CheckSession();
            require_once(VIEWS_PATH."company-list-catalogue.php");
        }

        public function Add($careerId, $dni, $fileNumber, $gender, $birthDate, $email, $phoneNumber)
        {
            Utils::CheckSession();
            
        
            $student = new Student();
            
            // agregar set studentId autoincremental tomando el ultimo de la base
            $Student->setCareerId($careerId);
            $student->setDni($dni);
            $student->setFileNumber($fileNumber);
            $student->setGender($gender);
            $student->setBirthDate($birthDate);
            $student->setEmail($email);
            $student->setPhoneNumber($phoneNumber);
            
            $this->studentDAO->AddMySql($student);

            $this->ShowLoginView();  
        }
    }
?>