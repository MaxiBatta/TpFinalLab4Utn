<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new companyDAO();
        }

       
        public function ShowListCompanyView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");  //crear en views vista con listado de empresas
        }
        
        public function ShowCompanyDetailView($message = '')
        {
            $_SESSION["actual_company"] = $_REQUEST["name"];
            require_once(VIEWS_PATH."company-detail.php");
        }
        
        public function ShowAddCompanyView($message = '')
        {
            require_once(VIEWS_PATH."company-add.php");
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
        

        public function Add($name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber)
        {
            $company = new Company();
            
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
        
        

        public function CompanySearch(){
            if ($_POST){  
        echo "Hacer logica para buscar compania, no llega por post la info";
            }
            
            $this->ShowListCompanyView();   
        }
        
        
        
        public function ShowSelectCompanyView($message = '')//usuario mb
        {
            
            require_once(VIEWS_PATH."company-select.php");
        }


    }
?>