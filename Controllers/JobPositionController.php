<?php
    namespace Controllers;

    use DAO\JobPositionDAO as JobPositionDAO;
    use Utils\Utils as Utils;
    use Controllers\AdministratorController as AdministratorController;
    use Models\JobPosition as JobPosition;
    
    
    class JobPositionController
    {

    private $jobPositionDAO;

        public function __construct()
        {
            $this->jobPositionDAO = new JobPositionDAO();
        }

        public function ShowFilteredJobPositionListView($message = '') {
            if (!$_REQUEST["description"]) {
                require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
                return;
            }
            else {
                $newJobOfferList = $this->jobPositionDAO->SearchJobPosition($_REQUEST["description"]);
                if (!$newJobOfferList) {
                    require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
                    return;
                }
                else {
                    $_SESSION["found_jobOffers"] = $newJobOfferList;
                    require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
                }
            }
        }
    
        
    }
?>