<?php

namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use Utils\Utils as Utils;
use Controllers\AdministratorController as AdministratorController;
use Controllers\StudentController as StudentController;
use Controllers\CompanyController as ComapanyController;
use Controllers\JobPositionController as JobPositionController;
use Models\JobOffer as JobOffer;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDao as CompanyDao;
use DAO\StudentDao as StudentDao;


class JobOfferController {

    private $jobOfferDAO;
    private $studentController;
    private $companyController;
    private $jobPositionController;

    public function __construct() {
        $this->jobOfferDAO = new JobOfferDAO();
        $this->studentController= new StudentController();
        $this->companyController= new CompanyController();
        $this->jobPositionController= new JobPositionController();
    }
    public function getAllInfo()
    {
        $jobOfferList= $this->jobOfferDAO->getAllMySql();
    }

    public function ShowJobOffersCatalogueView($message = '') {
        Utils::CheckBothSessions();
        $jobOfferList = $this->jobOfferDAO->GetAllMySql();
        $companyList= $this->companyController->getAllInfo();
        $jobPositionList= $this->jobPositionController->getAllInfo();

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
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList = $jobPositionDAO->getAll();
        $companyDAO = new CompanyDAO();
        $companiesList = $companyDAO->GetAllMySql();
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

    public function ShowJobOfferModifyView($message = '') {
        Utils::CheckAdmin();
        $_SESSION["actual_job-offer"] = $_REQUEST["job-offer-id"];
        $jobOfferDAO = new JobOfferDAO();
        $toModifyJobOffer = $jobOfferDAO->GetjobOfferById($_SESSION["toModifyJobOffer"]);
        unset($_SESSION["toModifyJobOffer"]);
        $studentDAO = new StudentDAO();
        $studentsList = $studentDAO->GetAllMySql();
        $jobPositionDAO = new JobPositionDAO();
        $jobPositionLists = $jobPositionDAO->GetAllMySql();
        $companyDAO = new CompanyDAO();
        $companiesList = $companyDAO->GetAllMySql();

        require_once(VIEWS_PATH . "job-offer-modify.php");
    }

    public function ShowOfferModifyView($jobofferid) {
        Utils::CheckAdmin();
        if ($_GET) {
            $_SESSION["toModifyJobOffer"] = $jobofferid;
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
        $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
        $jobOfferDAO = new JobOfferDAO();
        $jobOfferList = $jobOfferDAO->GetAllMySql();
        $actual_jobOffer = $jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);

        $jobPositionDAO = new JobPositionDAO();
        $jobPositionList = $jobPositionDAO->GetAllMySql();

        $companyDAO = new CompanyDAO();
        $companyList = $companyDAO->GetAllMySql();

        $studentDAO = new StudentDAO();
        $studentList = $studentDAO->GetAllMySql();

        require_once(VIEWS_PATH . "jobOffer-detail.php");
    }

    public function ApplyJob($studentId, $jobOfferId) {
        $_SESSION["toApply-student"] = $studentId;
        $studentEmail=$this->studentController->returnEmailById($studentId);
        echo "<script>console.log('$studentEmail')</script>";
        $jobOfferDAO = new JobOfferDAO();
        $jobOfferDAO = $this->jobOfferDAO->ApplyJobOffer($studentId, $jobOfferId, 0);
        $asunto="Postulacion a una posicion de trabajo";
        $mensaje="Felicitaciones te postulaste con exito a una posicion de trabajo";
        $headers = 'From: Your name <jair.sergio12@gmail.com>' . "\r\n";
        mail($studentEmail,$asunto,$mensaje,$headers);
        if ($jobOfferDAO) {
            $_SESSION["applyState"] = 1;
            
        } else {
            $_SESSION["applyState"] = 0;
        }
        
        require_once(VIEWS_PATH . "student-panel.php");
    }

}

?>