<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."loguin.php");
        }        

        public function LogOut()
        {
            require_once(VIEWS_PATH."logout.php");
            require_once(VIEWS_PATH."loguin.php");

        }        
    }
?>