<?php
namespace Utils;

class Utils{


    public static function CheckAdmin(){
        $esAdmin = isset($_SESSION["activeAdministrator"]) ? $_SESSION["activeAdministrator"] : false;
        if (!$esAdmin) {
            //redirect to homepage
            header("location:".FRONT_ROOT);
        
            //exit previene que se ejecute el codigo que continuaría
            exit;
        }
    }

    
    public static function CheckSession(){
        if (!isset($_SESSION["activeStudent"])) {
            //redirect to homepage
            header("location:".FRONT_ROOT."Login");
        }
    }
}
?>
