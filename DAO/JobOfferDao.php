<?php
    namespace DAO;

    
    use Models\JobOffer as JobOffer;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class JobOfferDAO
    {
        private $jobOfferList = array();
        private $connection;
        private $tableName = "jobOffers";
        private $tableName1 = "jobPositions";

        public function __construct() {
            $this->jobOfferList = array();
            
        }
    

    public function AddMySql(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( jobPositionId, dateTime, limitDate, state, companyId) VALUES ( :jobPositionId, :dateTime, :limitDate, :state, :companyId);";
                
                $parameters["jobPositionId"] = $jobOffer->getJobPositionId();
                $parameters["dateTime"] = $jobOffer->getDateTime();
                $parameters["limitDate"] = $jobOffer->getLimitDate();
                $parameters["state"] = $jobOffer->getState();
                $parameters["companyId"] = $jobOffer->getCompanyId();
                
        
                $this->connection = Connection::GetInstance();
        
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function GetAllMySql()
        {
            try
            {
                $jobOfferList = array();
        
                $query = "SELECT * FROM ".$this->tableName;
        
                $this->connection = Connection::GetInstance();
        
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobofferid"]);
                    $jobOffer->setDateTime($row["datetime"]);
                    $jobOffer->setLimitDate($row["limitdate"]);
                    $jobOffer->setState($row["state"]);
                    $jobOffer->setCompanyId($row["companyid"]);
                    $jobOffer->setJobPositionId($row["jobpositionid"]);
                    $jobOffer->setStudentId($row["studentid"]);
                    
                    array_push($jobOfferList, $jobOffer);
                }
        
                return $jobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
        
        public function returnJobOfferById($id) {
            $jobOfferList= $this->GetAllMySql();
    
            foreach ($jobOfferList as $jobOffer) {
                if ($jobOffer->getJObOfferId() == $id) {
                    return $jobOffer;
                }
            }
    
            return false;
        }

        public function SearchJobPosition($description) {
            
            try
            {
                $jobOfferList = array();
        
                $query = "SELECT * FROM .$this->tableName o  INNER JOIN .$this->tableName1 p  ON o.jobPositionId = p.jobPositionId WHERE description = '$description'" ;
        
                $this->connection = Connection::GetInstance();
        
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobofferid"]);
                    $jobOffer->setDateTime($row["datetime"]);
                    $jobOffer->setLimitDate($row["limitdate"]);
                    $jobOffer->setState($row["state"]);
                    $jobOffer->setCompanyId($row["companyid"]);
                    $jobOffer->setJobPositionId($row["jobpositionid"]);
                    $jobOffer->setStudentId($row["studentid"]);
        
                    array_push($jobOfferList, $jobOffer);
                }
        
                return $jobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
   }
 ?>

