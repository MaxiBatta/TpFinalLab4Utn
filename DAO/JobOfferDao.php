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

    public function AddMySql(JobOffer $jobOffer)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( dateTime, limitDate, state) VALUES ( :dateTime, :limitDate, :state);";
                
                
                $parameters["dateTime"] = $jobOffer->getDateTime();
                $parameters["limitDate"] = $jobOffer->getLimitDate();
                $parameters["state"] = $jobOffer->getState();
                
        
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
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                    $jobOffer->setDateTime($row["dateTime"]);
                    $jobOffer->setLimitDate($row["limitdate"]);
                    $jobOffer->setState($row["state"]);
                    
        
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

