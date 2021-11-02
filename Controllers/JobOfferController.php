<?php
    namespace Controllers;

    use Models\JobOffer as JobOffer;
    use Utils\Utils as Utils;
    
    class JobOfferController
    {
        public function ShowOffersCatalogueView($message = '')
        {
            Utils::CheckBothSessions();
            require_once(VIEWS_PATH."jobOffer-list-catalogue.php");
        }


        public function Add($jobPosition, $dateCreation, $dateLimit, $description, $company)
        {
            Utils::CheckAdmin();
            $JobOffer = new JobOffer();
            
            $JobOffer->setjobPosition($jobPosition);
            $JobOffer->setdateCreation($dateCreation);
            $JobOffer->setdateLimit($dateLimit);
            $JobOffer->setDescription($description);
            $JobOffer->setcompany($company);
            
            $this->JobOfferDAO->AddMySql($JobOffer);

            $this->ShowOffersCatalogueView();
        }
        public function ShowAddJobOfferView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."job-offer-add.php");
        }
        public function DeleteJobOffer($jobOfferId) {
            $this->jobOfferDAO->Delete($jobOfferId);
            
            $this->ShowListJobOfferView();
        }
        public function ShowDeleteJobOfferView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."job-offer-delete.php");
        }
        public function ModifyJobOffer($jobOfferId, $name, $yearFoundation, $city, $description, $logo, $email, $phoneNumber) {
            $jobOffer = new JobOffer();
            $jobOffer = $this->jobOfferDAO->returnjobOfferById($jobOfferId);

            if ($name) {
                $jobOffer->setName($name);
            }
            if ($yearFoundation) {
                $jobOffer->setYearFoundation($yearFoundation);
            }
            if ($city) {
                $jobOffer->setCity($city);
            }
            if ($description) {
                $jobOffer->setDescription($city);
            }
            if ($logo) {
                $jobOffer->setLogo($logo);
            }
            if ($email) {
                $jobOffer->setEmail($email);
            }
            if ($phoneNumber) {
                $jobOffer->setPhoneNumber($phoneNumber);
            }

            $this->jobOfferDAO->Modify($jobOffer);

            $this->ShowJobOffersCatalogueView();
        }
        public function ShowJobOfferModifyView($message = '')
        {
            Utils::CheckAdmin();
            $_SESSION["actual_job-offer"] = $_REQUEST["job-offer-id"];
            require_once(VIEWS_PATH."job-offer-modify.php");
        } 

        public function ShowJobOfferDetailView($message = '')
        {
            Utils::CheckBothSessions();
            $_SESSION["actual_jobOffer"] = $_REQUEST["jobOffer-id"];
            require_once(VIEWS_PATH."jobOffer-detail.php");
        }
        
    }
?>