<?php
    namespace DAO;

    
    use Models\JobPosition as JobPosition;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class JobPositionDAO
    {
        private $jobPositionList = array();
        private $connection;
        private $tableName = "jobPositions";

    public function AddMySql(JobPosition $jobPosition)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( careerId, description) VALUES ( :careerId, :description);";
                
                
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();
                
                
        
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
                $jobPositionList = array();
        
                $query = "SELECT * FROM ".$this->tableName;
        
                $this->connection = Connection::GetInstance();
        
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setCareerId($row["careerId"]);
                    $jobPosition->setDescription($row["description"]);
                   
                    
        
                    array_push($jobPositionList, $jobPosition);
                }
        
                return $jobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
   }
 ?>