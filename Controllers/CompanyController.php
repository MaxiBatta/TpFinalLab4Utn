<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Utils\Utils as Utils;
    use Controllers\AdministratorController as AdministratorController;
    

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
            $_SESSION["actual_company"] = $_REQUEST["company-id"];
            require_once(VIEWS_PATH."company-detail.php");
        }
        public function ShowCompanyModifyView($message = '')
        {
            Utils::CheckAdmin();
            $_SESSION["actual_company"] = $_REQUEST["company-id"];
            require_once(VIEWS_PATH."company-modify.php");
        } 
        public function ShowDeleteCompanyView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."company-delete.php");
        }
        public function ShowActiveCompanyView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."company-active.php");
        }
        public function ShowAddCompanyView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."company-add.php");
        }
        public function DeleteCompany($companyId) {
            $this->companyDAO->Delete($companyId);
            
            $this->ShowListCompanyView();
        }
        public function ActiveCompany($companyId) {
            $this->companyDAO->Active($companyId);

            $this->ShowListCompanyView();
        }
        public function ModifyCompany($companyId, $name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber) {
            $company = new Company();
            $company = $this->companyDAO->returnCompanyById($companyId);

            if ($name) {
                $company->setName($name);
            }
            if ($yearFoundation) {
                $company->setYearFoundation($yearFoundation);
            }
            if ($city) {
                $company->setCity($city);
            }
            if ($description) {
                $company->setDescription($city);
            }
            if ($logo) {
                $company->setLogo($logo);
            }
            if ($email) {
                $company->setEmail($email);
            }
            if ($phoneNumber) {
                $company->setPhoneNumber($phoneNumber);
            }

            $this->companyDAO->Modify($company);

            $this->ShowCompaniesCatalogueView();
        }

        public function Add($name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber)
        {
            Utils::CheckAdmin();
            $validate = Utils :: validateFormCompany($name,$city,$phoneNumber);
            $validateName= $this->companyDAO->ValidateCompanyNameMySql($name);
           
            
            if ($validateName){
            if ($validate){
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
            }
            else{
                echo "Error de carga";
            }}
            else{
                echo "Empresa ya registrada";
            }

            $this->ShowCompaniesCatalogueView();
        }
        
        public function ShowFilteredCompanyListView($message = '') {
            if (!$_REQUEST["name"]) {
                require_once(VIEWS_PATH."company-list-catalogue.php");
                return;
            }
            else {
                $newCompanyList = $this->companyDAO->SearchCompanyMySql($_REQUEST["name"]);
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