<?php

namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use Utils\Utils as Utils;
use Controllers\AdministratorController as AdministratorController;
use Controllers\StudentController as StudentController;
use Controllers\CompanyController as ComapanyController;
use Controllers\JobPositionController as JobPositionController;
use Models\JobOffer as JobOffer;

class JobOfferController {

    private $jobOfferDAO;

    public function __construct() {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    public function ShowJobOffersCatalogueView($message = '') {
        Utils::CheckBothSessions();
        
        $jobOfferList = $this->jobOfferDAO->GetAllMySql();
        
        $companyDAO = new CompanyDao();
        $companyList= $companyDAO->GetAllMySql();
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetAllMySql();

        require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
    }

    public function Add($dateTime, $limitDate, $state, $companyId, $jobPositionId) {
        Utils::CheckAdmin();
        
        $jobOffer = new JobOffer();

        $jobOffer->setDateTime($dateTime);
        $jobOffer->setLimitDate($limitDate);
        $jobOffer->setState($state);
        $jobOffer->setCompanyId($companyId);
        $jobOffer->setJobPositionId($jobPositionId);

        $this->jobOfferDAO->AddMySql($jobOffer);
        
        $this->ShowJobOffersCatalogueView();
    }
    
    public function ShowAddJobOfferView($message = '') {
        Utils::CheckAdmin();
        
        $companyDAO = new CompanyDao();
        $companyList= $companyDAO->GetAllMySql();
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetAllMySql();
        
        $today = date("Y") . '-' . date("m") . '-' . date("d");
        $tomorrow =date("Y") . '-' . date("m") . '-' . date("d");
        
        require_once(VIEWS_PATH . "job-offer-add.php");
    }

    public function DeleteJobOffer($jobOfferId) {
        $this->jobOfferDAO->Delete($jobOfferId);

        $this->ShowListJobOfferView();
    }

    public function ShowDeleteJobOfferView($message = '') {
        Utils::CheckAdmin();
        require_once(VIEWS_PATH . "job-offer-delete.php");
    }

    public function ShowJobOfferModifyView($jobofferid) {
        Utils::CheckAdmin();
        
        $toModifyJobOffer = $this->jobOfferDAO->returnJobOfferById($jobofferid);
        
        if ($_GET) {
            $_SESSION["toModifyJobOffer"] = $jobofferid;
            
            $companyDAO = new CompanyDao();
            $companyList= $companyDAO->GetAllMySql();

            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList= $jobPositionDAO->GetAllMySql();

            $studentDAO = new StudentDAO();
            $studentList= $studentDAO->GetAllMySql();
            
            require_once(VIEWS_PATH . "job-offer-modify.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }

    public function ModifyJobOffer($jobOfferId,$dateTime, $limitDate, $state, $companyId,$jobPositionId , $studentId) {   
        try
        {
            $jobOffer = new JobOffer();
            $jobOffer->setJobOfferId($jobOfferId);
            $jobOffer->setDateTime($dateTime);
            $jobOffer->setLimitDate($limitDate);
            $jobOffer->setCompanyId($companyId);
            $jobOffer->setJobPositionId($jobPositionId);
            $jobOffer->setStudentId($studentId);
            $jobOffer->setState($state);

            $this->jobOfferDAO->UpdateJobOffer($jobOfferId, $jobOffer);

            if (isset($_SESSION["adminLogged"])) {
                require_once(VIEWS_PATH."admin-panel.php");
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

    public function ShowJobOfferDetailView($message = '') {
        Utils::CheckBothSessions();
        
        if ($_GET) {
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            $actual_jobOffer = $this->jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);
            
            $companyDAO = new CompanyDao();
            $_SESSION["jobOffer_company"] = $companyDAO->returnCompanyByIdMySql($actual_jobOffer->getCompanyId());
            
            $jobPositionDAO = new JobPositionDAO();
            $_SESSION["jobOffer_position"] = $jobPositionDAO->returnJobPositionByIdMySql($actual_jobOffer->getJobPositionId());

            $studentDAO = new StudentDAO();
            $_SESSION["jobOffer_applied_student"] = $studentDAO->GetStudentById($actual_jobOffer->getStudentId());
            
            require_once(VIEWS_PATH . "joboffer-detail.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }
    
    public function ApplyJob($studentId, $jobOfferId) {
        $currentDate = date('m/d/Y', time()) . "T" . date('h:i:s', time());

        $jobOfferToApply = $this->jobOfferDAO->ApplyJobOffer($studentId, $jobOfferId, $currentDate);
        
        if ($jobOfferToApply) {
            $_SESSION["applyState"] = 1;
            
        } else {
            $_SESSION["applyState"] = 0;
        }
        
        require_once(VIEWS_PATH . "student-panel.php");
    }

}

?>