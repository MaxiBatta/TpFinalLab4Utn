<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }        

        public function LogOut()
        {
            require_once(VIEWS_PATH."logout.php");
            require_once(VIEWS_PATH."login.php");

        }
        public function Login ($email,$password)
        {
        if( $email == "admin@utn.com" && $password =="admin"){
       
                die("llegue");
                ///require_once(VIEWS_PATH."index.php");

        }
        else{
         $message= "Invalid Login";
        $this->ShowLoginView($message);
        }
        }        
    }
?>