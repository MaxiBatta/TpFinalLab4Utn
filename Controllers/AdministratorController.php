<?php
    namespace Controllers;

    use Models\Administrator as Administrator;
    use Utils\Utils as Utils;
    use Controllers\StudentController as StudentController;
    use Controllers\CareerController as CareerController;
    use DAO\StudentDao as StudentDAO;
    use DAO\CareerDao as CareerDAO;
    
    
    class AdministratorController
    {
        public function __construct()
        {
            
        }
        
        public function ShowPanelView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."admin-panel.php");
        }

        public function ShowOffersCatalogueView($message = '')
        {
            require_once(VIEWS_PATH."jobOffer-list-catalogue-admin.php");
        }
        
        public function ShowAdminStudentModifyView($id) {
            Utils::CheckAdmin();
            
            $studentDAO = new StudentDAO();
            $toModifyStudent = $studentDAO->GetStudentById($id);
            
            $careerDAO = new CareerDAO();
            $careersList = $careerDAO->GetAllMySql(); 
            
            if ($_GET) {
                $_SESSION["toModifyStudent"] = $id;
                require_once(VIEWS_PATH . "student-modify-admin.php");
            }
            else {
                $_SESSION["modifyError"] = 1;
                require_once(VIEWS_PATH . "admin-panel.php");
            }
        }
        
       
    }
?>