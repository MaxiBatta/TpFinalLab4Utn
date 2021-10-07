<?php
 namespace Controllers;
 class LoginController{
    public function Login ($email,$password)
    {
    if( $email == "admin@utn.com" && $password =="admin"){
   
            die("llegue");
            require_once(VIEWS_PATH."index.php");

    }
    else{
     $message= "Invalid Login";
    $this->ShowLoginView($message);
    }
    }  
 }
?>