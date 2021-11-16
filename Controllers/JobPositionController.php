<?php
    namespace Controllers;

    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use Utils\Utils as Utils;
    use Controllers\AdministratorController as AdministratorController;
    use Controllers\JobOfferController as JobOfferController;
    use Models\JobPosition as JobPosition;
    
    
    class JobPositionController
    {

    private $jobPositionDAO;

        public function __construct()
        {
            $this->jobPositionDAO = new JobPositionDAO();
        }
        public function getAllInfo(){
            $jobPositionList=$this->jobPositionDAO->getAllMySql();
            return  $jobPositionList;
        }
        
        public function ShowFilteredJobPositionListView($message = '') {
            $jobOfferDAO = new JobOfferDAO();
            $jobOfferController = new JobOfferController();

            if ($_REQUEST["description"]) {
                $jobOfferList = $jobOfferDAO->SearchJobPosition($_REQUEST["description"]);
                
                if (!$jobOfferList) {
                    $_SESSION["found_jobOffers"] = 0;
                }
                else {
                    $_SESSION["found_jobOffers"] = 1;
                }
                
                $companyDAO = new CompanyDao();
                $companyList = $companyDAO->GetAllMySql();

                $jobPositionDAO = new JobPositionDAO();
                $jobPositionList = $jobPositionDAO->GetAllMySql();
                
                require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
            }
            else {
                $jobOfferController->ShowJobOffersCatalogueView();
            }
        }
    }
?>