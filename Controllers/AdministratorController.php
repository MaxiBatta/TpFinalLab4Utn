<?php
    namespace Controllers;

    use Models\Administrator as Administrator;
    use Utils\Utils as Utils;
    
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
        
        public function ShowCompaniesCatalogueView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."company-list-catalogue.php");
        }

        public function ShowOffersCatalogueView($message = '')
        {
            require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
        }
        
        public function ShowAdminModifyView($id) {
            Utils::CheckAdmin();
            if ($_GET) {
                $_SESSION["toModifyStudent"] = $id;
                require_once(VIEWS_PATH . "student-modify-admin.php");
            }
        }
        
       
    }
?>