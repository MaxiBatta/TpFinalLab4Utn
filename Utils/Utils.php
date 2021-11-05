<?php

namespace Utils;

class Utils {
    /*
     * Checkea la sesión de Administrador.
     */

    public static function CheckAdmin() {
        if (!isset($_SESSION["activeAdministrator"])) {
            $_SESSION["notLogged"] = true;
            header("location:" . FRONT_ROOT . "index.php");

            exit;
        } else {
            $_SESSION["adminLogged"] = true;
        }
    }

    /*
     * Checkea la sesión de Estudiante.
     */

    public static function CheckSession() {
        if (!isset($_SESSION["activeStudent"])) {
            $_SESSION["notLogged"] = true;
            header("location:" . FRONT_ROOT . "index.php");

            exit;
        } else {
            $_SESSION["studentLogged"] = true;
        }
    }

    /*
     * Checkea ambas sesiones, se utiliza con la intención de acceder a vistas compartidas en ambos usuarios.
     */

    public static function CheckBothSessions() {
        if (!isset($_SESSION["activeAdministrator"]) && !isset($_SESSION["activeStudent"])) {
            $_SESSION["notLogged"] = true;
            header("location:" . FRONT_ROOT . "index.php");

            exit;
        } else {
            if (isset($_SESSION["activeAdministrator"])) {
                $_SESSION["adminLogged"] = true;
            } else {
                $_SESSION["studentLogged"] = true;
            }
        }
    }

    public static function ValidateFormCompany($name, $city, $phoneNumber) {

        $validate = false;

        if (preg_match("/^[a-zA-Z\s]+$/", $name) && preg_match("/^[a-zA-Z\s]+$/", $city) && is_numeric($phoneNumber)) {
            $validate = true;
        }


        return $validate;
    }
}

?>
