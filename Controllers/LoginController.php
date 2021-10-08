<?php
 namespace Controllers;
 use DAO\StudentDAO as StudentDAO;
 class LoginController{
    public function Login ($email)
    {
    $Students = new StudentDAO();
    $StudentsList = $Students->GetAll();
    foreach($StudentsList as $key => $value){ 
            if($email == $value->getEmail()){
            die("llegue");
            require_once(VIEWS_PATH."prueba.php");
        }else{
            echo("Sin coincidencia");
        }

    }
    /*else if($email == "admin@utn.com"){
        
    }
    else{
        echo "<script> if(confirm('Los datos ingresados son invalidos.'));";
        echo "window.location = 'index.php';</script>";
    }
    }  */
 }
}
?>