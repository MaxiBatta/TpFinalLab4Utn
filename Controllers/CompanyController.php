<?php

namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;
use Utils\Utils as Utils;
use Controllers\AdministratorController as AdministratorController;

class CompanyController {

    private $companyDAO;

    public function __construct() {
        $this->companyDAO = new CompanyDAO();
    }
    public function ShowListCompanyView() {
        Utils::CheckBothSessions();
        $companyList = $this->companyDAO->GetAllMySql();
        require_once(VIEWS_PATH . "company-list.php");  //crear en views vista con listado de empresas
    }

    public function ShowCompaniesCatalogueView($message = '') {
        Utils::CheckBothSessions();
        $companyList = $this->companyDAO->GetAllMySql();
        require_once(VIEWS_PATH . "company-list-catalogue.php");
    }

    public function ShowCompanyDetailView($message = '') {
        Utils::CheckBothSessions();
        
        if ($_GET) {
            $_SESSION["actual_company"] = $_REQUEST["company-id"];
            $actual_company = $this->companyDAO->returnCompanyByIdMySql($_SESSION["actual_company"]);
            require_once(VIEWS_PATH . "company-detail.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }

    public function ShowCompanyModifyView($companyId) {
        Utils::CheckAdmin();
        $toModifyCompany = $this->companyDAO->returnCompanyByIdMySql($companyId);
        
        if ($_GET) {
            $_SESSION["toModifyCompany"] = $companyId;
            require_once(VIEWS_PATH . "company-modify.php");
        }
        else {
            $_SESSION["modifyError"] = 1;
            require_once(VIEWS_PATH . "admin-panel.php");
        }
    }

    public function ShowDeleteCompanyView($message = '') {
        Utils::CheckAdmin();
        require_once(VIEWS_PATH . "company-delete.php");
    }

    public function ShowActiveCompanyView($message = '') {
        Utils::CheckAdmin();
        require_once(VIEWS_PATH . "company-active.php");
    }

    public function ShowAddCompanyView($message = '') {
        Utils::CheckAdmin();
        require_once(VIEWS_PATH . "company-add.php");
    }

    public function DeleteCompany($companyId) {
        $this->companyDAO->Delete($companyId);

        $this->ShowListCompanyView();
    }

    public function ActiveCompany($companyId) {
        $this->companyDAO->Active($companyId);

        $this->ShowListCompanyView();
    }

    public function ModifyCompany($companyId, $name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber, $active) {
        try {
            $company = new Company();
            $company->setCompanyId($companyId);
            $company->setName($name);
            $company->setYearFoundation($yearFoundation);
            $company->setCity($city);
            $company->setDescription($description);
            $company->setLogo($logo);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            $company->setActive($active);

            $this->companyDAO->UpdateCompany($companyId, $company);

            require_once(VIEWS_PATH . "admin-panel.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function Add($name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber) {
        Utils::CheckAdmin();
        $validate = Utils :: validateFormCompany($name, $city, $phoneNumber);
        $validateName = $this->companyDAO->ValidateCompanyNameMySql($name);


        if ($validateName) {
            if ($validate) {
                $company = new Company();

                //$company->setCompanyId($lastId);
                $company->setName($name);
                $company->setYearFoundation($yearFoundation);
                $company->setCity($city);
                $company->setDescription($description);
                $company->setLogo($logo);
                $company->setEmail($email);
                $company->setPhoneNumber($phoneNumber);

                $this->companyDAO->AddMySql($company);
            } else {
               $_SESSION ["validateError"] = 1;
               $this->ShowCompaniesCatalogueView();
            }
        } else {
            $_SESSION ["validateError"] = 2;
            $this->ShowCompaniesCatalogueView();
        }
        $_SESSION ["validateError"] = 0;

        $this->ShowCompaniesCatalogueView();
    }

    public function ShowFilteredCompanyListView($message = '') {
        if ($_REQUEST["name"]) {
            $companyList = $this->companyDAO->SearchCompanyMySql($_REQUEST["name"]);
            
            if (!$companyList) {
                $_SESSION["found_companies"] = 0;
            }
            else {
                $_SESSION["found_companies"] = 1;
            }
            
            require_once(VIEWS_PATH . "company-list-catalogue.php");
        }
        else {
            $this->ShowCompaniesCatalogueView();
        }
    }
}

?>