<?php
    namespace Controllers;

    use DAO\JobOfferDAO as JobOfferDAO;
    use Utils\Utils as Utils;
    use Controllers\AdministratorController as AdministratorController;
    use Models\JobOffer as JobOffer;
    
    
    class JobOfferController
    {

    private $jobOfferDAO;

        public function __construct()
        {
            $this->jobOfferDAO = new JobOfferDAO();
        }

    
        public function ShowJobOffersCatalogueView($message = '')
        {
            Utils::CheckBothSessions();
            require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
        }


        public function Add($jobPositionId,$companyId,$dateTime, $limitDate, $state)
        {
            Utils::CheckAdmin();
            
            $jobOffer = new JobOffer();
            
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setDateTime($dateTime);
            $jobOffer->setLimitDate($limitDate);
            $jobOffer->setState($state);
            $jobOffer->setCompanyId($companyId);
            
            
            $this->jobOfferDAO->AddMySql($jobOffer);

            $this->ShowJobOffersCatalogueView();
        }
        public function ShowAddJobOfferView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."job-offer-add.php");
        }
        public function DeleteJobOffer($jobOfferId) {
            $this->jobOfferDAO->Delete($jobOfferId);
            
            $this->ShowListJobOfferView();
        }
        public function ShowDeleteJobOfferView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."job-offer-delete.php");
        }
       
        public function ShowJobOfferModifyView($message = '')
        {
            Utils::CheckAdmin();
            $_SESSION["actual_job-offer"] = $_REQUEST["job-offer-id"];
            require_once(VIEWS_PATH."job-offer-modify.php");
        } 
        public function ShowOfferModifyView($jobofferid){
            Utils::CheckAdmin();
            if ($_GET) {
                $_SESSION["toModifyJobOffer"] = $jobofferid;
                require_once(VIEWS_PATH . "job-offer-modify.php");
                exit();
            }
        }
        public function ModifyJobOffer($jobOfferId,$dateTime, $limitDate, $state, $companyId,$jobPositionId , $studentId) {   
            try
            {
                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($jobOfferId);
                
                $foundJobOffer = $this->jobOfferDAO->GetJobOfferById($jobOfferId);
                
                $dateTime ? $jobOffer->setDateTime($dateTime) : $jobOffer->setDateTime($foundJobOffer->getDateTime());
                $limitDate ? $jobOffer->setLimitDate($limitDate) : $jobOffer->setLimitDate($foundJobOffer->getLimitDate());
                $state ? $jobOffer->setState($state) : $jobOffer->setState($foundJobOffer->getState());
                $companyId ? $jobOffer->setCompanyId($companyId) : $jobOffer->setCompanyId($foundJobOffer->getCompanyId());
                $jobPositionId ? $jobOffer->setJobPositionId($jobPositionId) : $jobOffer->setJobPositionId($foundJobOffer->getJobPositionId());
                $studentId ? $jobOffer->setStudentId($studentId) : $jobOffer->setStudentId($foundJobOffer->getStudentId());
                
                $_SESSION["activeJobOffer"] = $jobOffer;
                
                $this->jobOfferDAO->UpdateJobOffer($jobOfferId, $jobOffer);
                
                if (isset($_SESSION["adminLogged"])) {
                    require_once(VIEWS_PATH."admin-panel.php");
                    exit();
                }
                else {
                    $this->ShowPanelView();
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
        public function ShowJobOfferDetailView($message = '')
        {
            Utils::CheckBothSessions();
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            require_once(VIEWS_PATH."jobOffer-detail.php");
        }
        
        public function ApplyJob($studentId, $jobOfferId) {
            $_SESSION["toApply-student"] = $studentId;
            
            $jobOfferDAO = new JobOfferDAO();
            $jobOfferDAO = $this->jobOfferDAO->ApplyJobOffer($studentId, $jobOfferId, 0);
            
            if ($jobOfferDAO) {
                $_SESSION["applyState"] = 1;
            }
            else {
                $_SESSION["applyState"] = 0;
            }
            require_once(VIEWS_PATH."student-panel.php");
            
        }
        
    }
?>