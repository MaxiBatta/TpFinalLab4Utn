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

        public function __construct() {
            $this->jobPositionList = array();
            
        }
        public function GetAll() {
            $this->RetrieveData();
    
            return $this->jobPositionList;
        }
        private function RetrieveData()
        {
            $this->jobPositionList = array();

            $apiJobPosition = curl_init(API_URL .'JobPosition');

            curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array('x-api-key: '.API_KEY));
            curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);
                    
            $response = curl_exec($apiJobPosition);

            $arrayToDecode = json_decode($response, true);

            foreach($arrayToDecode as $valuesArray)
                {
                    $jobPosition = new JobPosition();
                    $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
                    $jobPosition->setCareerId($valuesArray["careerId"]);
                    $jobPosition->setDescription($valuesArray["description"]);
                  
                    array_push($this->jobPositionList, $jobPosition);
                }
            
        }
        

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

        public function SearchJobPosition($description) {
            
            $jobPositionList = $this->GetAllMySql();
    
            foreach ($jobPositionList as $jobPosition) {
                
                if (stristr($jobPosition->getDescription(), strval($description)) === FALSE) {
                    continue;
                }
    
                array_push($jobPositionList, $jobPosition);
            }
    
            return count($jobPositionList) > 0 ? $jobPositionList : false;
        }
   }
 ?>