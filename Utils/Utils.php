<?php
namespace Utils;

class Utils{

    /*
     * Checkea la sesión de Administrador.
     */
    public static function CheckAdmin(){
        if (!isset($_SESSION["activeAdministrator"])) {
            $_SESSION["notLogged"] = true;
            header("location:".FRONT_ROOT."index.php");
        
            exit;
        }
    }
    
    /*
     * Checkea la sesión de Estudiante.
     */
    public static function CheckSession(){
        if (!isset($_SESSION["activeStudent"])) {
            $_SESSION["notLogged"] = true;
            header("location:".FRONT_ROOT."index.php");
            
            exit;
        }
    }
    
    /*
     * Checkea ambas sesiones, se utiliza con la intención de acceder a vistas compartidas en ambos usuarios.
     */
    public static function CheckBothSessions(){
        if (!isset($_SESSION["activeAdministrator"]) && !isset($_SESSION["activeStudent"])) {
            $_SESSION["notLogged"] = true;
            header("location:".FRONT_ROOT."index.php");
            
            exit;
        }
    }
}
?>
