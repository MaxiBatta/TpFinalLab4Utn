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
   

        public function ShowLoguinView($message = '')
        {
            require_once(VIEWS_PATH."loguin.php");
        }



        public function Loguin ($userName)
        {
            if( $userName == "admin@utn.com" ){
       

                require_once(VIEWS_PATH."index.php");

        }else
        {
            $message= "Invalid Loguin";
            $this->ShowLoguinView($message);

        }
        }

    }
?>