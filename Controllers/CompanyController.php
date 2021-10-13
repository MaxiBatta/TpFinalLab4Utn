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

        public function ShowAddCompanyView($message = '')
        {
            require_once(VIEWS_PATH."company-add.php");
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
        
        

        public function Select($name) //usuario mb
        {
            
            $companyList = $this->companyDAO->GetAll();

            foreach ($companyList as $eachCompany){
                    if ($name == $eachCompany->getName() ){
                        echo $eachCompany;
                    }else{
                        echo "No hay coincidencias";
                          }
                    }
            
         $this->ShowSelectCompanyView();   
        }
        
        public function ShowSelectCompanyView($message = '')//usuario mb
        {
            require_once(VIEWS_PATH."company-filter.php");
        }





    }
?>