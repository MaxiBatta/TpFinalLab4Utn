<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Utils\Utils as Utils;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

       
        public function ShowListCompanyView()
        {
            Utils::CheckBothSessions();
            require_once(VIEWS_PATH."company-list.php");  //crear en views vista con listado de empresas
        }
        
        public function ShowCompaniesCatalogueView($message = '')
        {
            Utils::CheckBothSessions();
            require_once(VIEWS_PATH."company-list-catalogue.php");
        }
        
        public function ShowCompanyDetailView($message = '')
        {
            Utils::CheckBothSessions();
            $_SESSION["actual_company"] = $_REQUEST["name"];
            require_once(VIEWS_PATH."company-detail.php");
        }
        
        public function ShowAddCompanyView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."company-add.php");
        }

        public function Add($name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber)
        {
            Utils::CheckAdmin();
            
            $lastCompany = $this->companyDAO->getLast();
            $lastId = 1;
            
            if ($lastCompany) {
                $lastId = $lastCompany->getCompanyId();
                $lastId++;
            }
            
            $company = new Company();
            
            $company->setCompanyId($lastId);
            $company->setName($name);
            $company->setYearFoundation($yearFoundation);
            $company->setCity($city);
            $company->setDescription($description);
            $company->setLogo($logo);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);
            
            $this->companyDAO->Add($company);

            $message= "Company Added!!";
            $this->ShowAddCompanyView($message);   
        }
        
        public function ShowSelectCompanyView($message = '')//usuario mb
        {
            
            require_once(VIEWS_PATH."company-select.php");
        }
        
        public function ShowFilteredCompanyListView($message = '') {
            if (!$_REQUEST["name"]) {
                require_once(VIEWS_PATH."company-list-catalogue.php");
                return;
            }
            else {
                $newCompanyList = $this->companyDAO->SearchCompany($_REQUEST["name"]);
                if (!$newCompanyList) {
                    require_once(VIEWS_PATH."company-list-catalogue.php");
                    return;
                }
                else {
                    $_SESSION["found_companies"] = $newCompanyList;
                    require_once(VIEWS_PATH."company-list-catalogue.php");
                }
            }
        }

    }
?>