<?php

namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\JobOfferByStudentDAO as JobOfferByStudentDAO;
use Utils\Utils as Utils;
use Controllers\AdministratorController as AdministratorController;
use Controllers\StudentController as StudentController;
use Controllers\CompanyController as ComapanyController;
use Controllers\JobPositionController as JobPositionController;
use Controllers\MailController as MailController;
use Models\JobOffer as JobOffer;

class JobOfferController {

    private $jobOfferDAO;

    public function __construct() {
        $this->jobOfferDAO = new JobOfferDAO();
    }

    public function ShowJobOffersCatalogueView($message = '') {
        Utils::CheckSession();
        
        $jobOfferList = $this->jobOfferDAO->GetAllMySql();
        
        $companyDAO = new CompanyDao();
        $companyList= $companyDAO->GetAllMySql();
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetAllMySql();

        require_once(VIEWS_PATH . "jobOffer-list-catalogue.php");
    }
    
    public function ShowJobOffersAdminCatalogueView($message = '') {
        Utils::CheckAdmin();
        
        $jobOfferList = $this->jobOfferDAO->GetAllMySql();
        
        $companyDAO = new CompanyDao();
        $companyList= $companyDAO->GetAllMySql();
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetAllMySql();
        
        require_once(VIEWS_PATH . "jobOffer-list-catalogue-admin.php");
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
        
        $this->ShowJobOffersAdminCatalogueView();
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
    
    public function ShowDeclineJobOfferView() {
        Utils::CheckAdmin();
        if ($_GET) {
            $_SESSION["actualJobOfferDate"] = $_GET["postulationdate"];
            require_once(VIEWS_PATH . "job-offer-declination.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }
    
    public function ShowJobOffersStudentRecordView($message = '') {
        Utils::CheckSession();
        
        $jobOfferList = $this->jobOfferDAO->GetAllMySql();
        
        $companyDAO = new CompanyDao();
        $companyList= $companyDAO->GetAllMySql();
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetAllMySql();
        
        $jobOfferByStudentDAO = new JobOfferByStudentDAO();
        $jobOfferByStudentList = $jobOfferByStudentDAO->GetAllJobOffersByStudent($_SESSION["activeStudent"]->getStudentId());
        
        $jobOfferByStudentPostulationDates = $jobOfferByStudentDAO->GetJobOffersByStudentByStudent($_SESSION["activeStudent"]->getStudentId());
        
        require_once(VIEWS_PATH . "job-offer-student-record.php");
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
    
    public function ShowJobOfferCompanyModifyView($jobofferid) {
        Utils::CheckCompany();
        
        $toModifyJobOffer = $this->jobOfferDAO->returnJobOfferById($jobofferid);
        
        if ($_GET) {
            $_SESSION["toModifyJobOffer"] = $jobofferid;
            
            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList= $jobPositionDAO->GetAllMySql();

            $studentDAO = new StudentDAO();
            $studentList= $studentDAO->GetAllMySql();
            
            require_once(VIEWS_PATH . "job-offer-company-modify.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "company-panel.php");
        }
    }
    
    public function ShowJobOffersCatalogueCompanyView($message = '') {
        Utils::CheckCompany();
        
        $jobOfferList = $this->jobOfferDAO->GetJobOfferByCompanyIdMySql($_SESSION["activeCompany"]->getCompanyId());
        
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList= $jobPositionDAO->GetJobPositionByCompanyIdMySql($_SESSION["activeCompany"]->getCompanyId());

        require_once(VIEWS_PATH . "company-joboffer-list-catalogue.php");
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
                $this->ShowJobOffersCatalogueCompanyView();
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function ShowJobOfferDetailView($message = '') {
        Utils::CheckSession();
        
        if ($_GET) {
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            $actual_jobOffer = $this->jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);
            
            $companyDAO = new CompanyDao();
            $_SESSION["jobOffer_company"] = $companyDAO->returnCompanyByIdMySql($actual_jobOffer->getCompanyId());
            
            $jobPositionDAO = new JobPositionDAO();
            $_SESSION["jobOffer_position"] = $jobPositionDAO->returnJobPositionByIdMySql($actual_jobOffer->getJobPositionId());

            $jobOfferByStudentDAO = new JobOfferByStudentDAO();

            if (isset($_SESSION["adminLogged"])) {
                $jobOfferByStudentList = $jobOfferByStudentDAO->GetAllStudents();
            }
            else {
                if (isset($_REQUEST["from-record"])) {
                    $_SESSION["from_record"] = 1;
                }
                else {
                    $postulationExists = $jobOfferByStudentDAO->GetJobOfferByJobOfferIdAndStudentId($actual_jobOffer->getJobOfferId(),  $_SESSION["activeStudent"]->getStudentId());

                    if ($postulationExists) {
                        $_SESSION["jobOffer_applied_student"] = 1;
                    }
                    else {
                        $_SESSION["jobOffer_applied_student"] = 0;
                    }
                }
            }
            
            require_once(VIEWS_PATH . "joboffer-detail.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }

    public function ShowJobOfferAdminDetailView($message = '') {
        Utils::CheckAdmin();
        
        if ($_GET) {
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            $actual_jobOffer = $this->jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);
            
            $companyDAO = new CompanyDao();
            $_SESSION["jobOffer_company"] = $companyDAO->returnCompanyByIdMySql($actual_jobOffer->getCompanyId());
            
            $jobPositionDAO = new JobPositionDAO();
            $_SESSION["jobOffer_position"] = $jobPositionDAO->returnJobPositionByIdMySql($actual_jobOffer->getJobPositionId());

            $jobOfferByStudentDAO = new JobOfferByStudentDAO();
            $jobOfferByStudentList = $jobOfferByStudentDAO->GetAllStudentsByJobOffer($_SESSION["actual_jobOffer"]);
            
            require_once(VIEWS_PATH . "joboffer-detail-admin.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }

    public function ShowJobOfferCompanyDetailView($message = '') {
        Utils::CheckCompany();
        
        if ($_GET) {
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            $actual_jobOffer = $this->jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);
            
            $companyDAO = new CompanyDao();
            $_SESSION["jobOffer_company"] = $companyDAO->returnCompanyByIdMySql($actual_jobOffer->getCompanyId());
            
            $jobPositionDAO = new JobPositionDAO();
            $_SESSION["jobOffer_position"] = $jobPositionDAO->returnJobPositionByIdMySql($actual_jobOffer->getJobPositionId());

            $jobOfferByStudentDAO = new JobOfferByStudentDAO();
            $jobOfferByStudentList = $jobOfferByStudentDAO->GetAllStudentsByJobOffer($_SESSION["actual_jobOffer"]);
            
            require_once(VIEWS_PATH . "joboffer-detail-company.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }
    
    public function ApplyJob($studentId, $jobOfferId) {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('m/d/Y', time()) . "T" . date('h:i:s', time());

        $jobOfferToApply = $this->jobOfferDAO->ApplyJobOffer($studentId, $jobOfferId, $currentDate);
        
        if ($jobOfferToApply) {
            $_SESSION["applyState"] = 1;
            
        } else {
            $_SESSION["applyState"] = 0;
        }
        
        require_once(VIEWS_PATH . "student-panel.php");
    }
    
    public function SendMailsToStudents() {
        $jobOfferByStudentDAO = new JobOfferByStudentDAO();
        $postulationList = $jobOfferByStudentDAO->GetAllMySql();
        
        $jobOfferDAO = new JobOfferDAO();
        
        $mailController = new MailController();
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentDate = date('m/d/Y', time()) . "T" . date('h:i:s', time());
        
        $currentDateFormat = strtotime($currentDate);
        
        foreach ($postulationList as $postulation) {

            if ($postulation->getMailSent() == 1) {
                continue;
            }
            
            $jobOffer = $jobOfferDAO->returnJobOfferById($postulation->getJobOfferId());
            
            $jobOfferLimit = strtotime($jobOffer->getLimitDate());

            if ($jobOfferLimit < $currentDateFormat) {
                $mailController->SendMailEndJobOfferToStudents($postulation);
            }
        }
        
        if (!isset($_SESSION["succefully-sent-mails"])) {
            $_SESSION["succefully-sent-mails"] = 1;
        }
        
        $adminController = new AdministratorController();
        $adminController->ShowPanelView();
    }
    
    public function DeclineJobOffer($postulationDate, $mailcontent) {
        $jobOfferByStudentDAO = new JobOfferByStudentDAO();
        $postulation = $jobOfferByStudentDAO->returnJobPositionByIdPostulationDate($postulationDate);
        
        $jobOfferByStudentDAO->UpdateActiveJobOfferByStudent($postulation->getJobOfferByStudentId(), 0);
        
        $mailController = new MailController();
        $mailController->SendMailDeclineJobOffer($postulation, $mailcontent);
        
        if (!isset($_SESSION["succefully-sent-mails"])) {
            $_SESSION["succefully-sent-mails"] = 1;
        }
        
        $adminController = new AdministratorController();
        $adminController->ShowPanelView();
        
        
    }
}

?>