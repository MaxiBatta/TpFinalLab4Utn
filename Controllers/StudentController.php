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



        /*public function Login ($userName)
        {
        if( $userName == "admin@utn.com" && $password =="admin"){
       
                die("llegue")
                require_once(VIEWS_PATH."index.php");

        }
       if else()
        {
            

        }else{
         $message= "Invalid Login";
        $this->ShowLoginView($message);
        }
        }*/

    }
?>