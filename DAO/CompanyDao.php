<?php
    namespace DAO;

    use DAO\ICompanyDao as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDao implements ICompanyDAO
    {
        private $companyList = array();

        public function Add(Company $company)
        {
            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->companyList as $company)
            {
                $valuesArray["name"] = $company->getName();
                $valuesArray["yearFoundation"] = $company->getYearFoundation();
                $valuesArray["city"] = $company->getCity();
                $valuesArray["description"] = $company->getDescription();
                $valuesArray["logo"] = $company->getLogo();
                $valuesArray["email"] = $company->getEmail();
                $valuesArray["phoneNumber"] = $company->getPhoneNumber();
                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/companies.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->companyList = array();

            if(file_exists('Data/companies.json'))
            {
                $jsonContent = file_get_contents('Data/companies.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $company = new Company();
                    $company->setName($valuesArray["name"]);
                    $company->setYearFoundation($valuesArray["yearFoundation"]);
                    $company->setCity($valuesArray["city"]);
                    $company->setDescription($valuesArray["description"]);
                    $company->setLogo($valuesArray["logo"]);
                    $company->setEmail($valuesArray["email"]);
                    $company->setPhoneNumber($valuesArray["phoneNumber"]);
                    
                    array_push($this->companyList, $company);
                }
            }
        }
    }
?>