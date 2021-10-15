<?php
    namespace DAO;

    use DAO\ICompanyDao as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDao implements ICompanyDAO
    {
        private $fileName;
        private $companyList;
        
        public function __construct() {
            $this->companyList = array();
            $this->fileName = dirname(__DIR__)."/Data/companies.json";
        }
        
        public function Add(Company $company)
        {
            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }
        
        /**
         * @param bool $active Por defecto trae empresas inactivas, pasarle false para que traiga sólo activas
         * @return companyList Retorna la lista
         */
        public function GetAll($active = true, $onlyInactive=false)
        {
            if($onlyInactive){
              $this->RetrieveData(true , true);
            }
            else{
            if (!$active) {
                $this->RetrieveData(false);
            }
            else {
                $this->RetrieveData();
            }

            
            }
            return $this->companyList;
        }
        
        public function getLast() {
            $this->RetrieveData();
            return end($this->companyList);
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["companyId"] = $company->getCompanyId();
                $valuesArray["name"] = $company->getName();
                $valuesArray["yearFoundation"] = $company->getYearFoundation();
                $valuesArray["city"] = $company->getCity();
                $valuesArray["description"] = $company->getDescription();
                $valuesArray["logo"] = $company->getLogo();
                $valuesArray["email"] = $company->getEmail();
                $valuesArray["phoneNumber"] = $company->getPhoneNumber();
                $valuesArray["active"] = $company->getActive();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData($active = true,$onlyInactive=false)
        {
            $this->companyList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    if($onlyInactive)
                    {
                        if ($valuesArray["active"] == false) {
                            continue;
                        }
                    }else{
                    if ($valuesArray["active"] == false && !$active) {
                        continue;
                    }
                    }
                    $company = new Company();
                    $company->setCompanyId($valuesArray["companyId"]);
                    $company->setName($valuesArray["name"]);
                    $company->setYearFoundation($valuesArray["yearFoundation"]);
                    $company->setCity($valuesArray["city"]);
                    $company->setDescription($valuesArray["description"]);
                    $company->setLogo($valuesArray["logo"]);
                    $company->setEmail($valuesArray["email"]);
                    $company->setPhoneNumber($valuesArray["phoneNumber"]);
                    $company->setActive($valuesArray["active"]);
                    
                    
                    array_push($this->companyList, $company);
                }
            }
        }

        public function Remove(Company $removingCompany){
            //Get array from data file
            $this->RetrieveData();
        
            //Search Company in the array
        
            if(($index = array_search($removingCompany, $this->companyList)) != false){
                //Remove it from array if found 
                unset($this->companyList[$index]);
            }
        
            //Save array to data file
            $this->SaveData();
        }
        
        public function returnCompanyByName($name)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company)
            {  
                if($company->getName() == $name)
                {
                    return $company;
                }
            }
            
            return false;
        }
        
        public function SearchCompany($name)
        {
            $this->RetrieveData();
            $companyList = [];

            foreach($this->companyList as $company)
            {
                if (!$company->getActive()) {
                    continue;
                }
                if (stristr($company->getName(), strval($name)) === FALSE) {
                    continue;
                }

                array_push($companyList, $company);
            }
        
            return count($companyList) > 0 ? $companyList : false;
        }
        public function returnCompanyById($id)
        {
            $this->RetrieveData();

            foreach($this->companyList as $company)
            {
                if($company->getCompanyId() == $id)
                {
                    return $company;
                }
            }

            return false;
        }
        public function returnKeyById($id)
        {
            $this->RetrieveData();

            foreach($this->companyList as $key => $company)
            {
                if($company->getCompanyId() == $id) {
                    return $key;
                }
            }

            return false;
        }

        public function Delete($id) 
        {
            $this->RetrieveData();
            $key = $this->returnKeyById($id);

            if (!$key) {
                $_SESSION["companyNotFound"] = 1;
                return;
            }

            $this->companyList[$key]->setActive(false);
            $this->SaveData();
        }
        public function Active($id) 
        {
            $this->RetrieveData();
            $key = $this->returnKeyById($id);

            if (!$key) {
                $_SESSION["companyNotFound"] = 1;
                return;
            }

            $this->companyList[$key]->setActive(true);
            $this->SaveData();
        }

        public function Modify(Company $company)
        {
            $this->RetrieveData();
            $key = $this->returnKeyById($company->getCompanyId());
            $this->companyList[$key] = $company;
            $this->SaveData();
        }
        
    }
?>