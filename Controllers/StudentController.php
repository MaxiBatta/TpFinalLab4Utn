<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }
   

        public function ShowLoginView($message = '')
        {
            require_once(VIEWS_PATH."login.php");
        }
        
        public function ShowPanelView($message = '')
        {
            require_once(VIEWS_PATH."student-panel.php");
        }
        
        public function ShowPersonalDataView($message = '')
        {
            require_once(VIEWS_PATH."student-personal-data.php");
        }
        
        public function ShowCompaniesView($message = '')
        {
            require_once(VIEWS_PATH."company-list.php");
        }
        
        public function ShowCompaniesCatalogueView($message = '')
        {
            require_once(VIEWS_PATH."company-list-catalogue.php");
        }
    }
?>