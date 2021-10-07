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

       
        public function ShowListCompaniesView()
        {
            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");  //crear en views vista con listado de empresas
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

           
            /*$this->ShowAddCompanyView();   // crear en views vista "ShowAddCompanyView" para agregar empresas*/
        }
        
        public function Remove(Company $company)
        {
            
            $this->companyDAO->Remove($company);
            
           /* $this->ShowAddCompanyView();   // crear vista a donde direcciona luego de eliminar una empresa*/
        }






    }
?>