<?php
    namespace DAO;

    
    use Models\Career as Career;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CareerDAO
    {
        private $careerList = array();
        private $connection;
        private $tableName = "careers";

        public function __construct() {
            $this->careerList = array();
            
        }
    
        public function GetAll() {
            $this->RetrieveData();
    
            return $this->careerList;
        }
        private function RetrieveData()
        {
            $this->careerList = array();

            $apiCareer = curl_init(API_URL .'Career');

            curl_setopt($apiCareer, CURLOPT_HTTPHEADER, array('x-api-key: '.API_KEY));
            curl_setopt($apiCareer, CURLOPT_RETURNTRANSFER, true);
                    
            $response = curl_exec($apiCareer);

            $arrayToDecode = json_decode($response, true);

            foreach($arrayToDecode as $valuesArray)
                {
                    $career = new Career();
                    $career->setCareerId($valuesArray["careerId"]);
                    $career->setDescription($valuesArray["description"]);
                    $career->setActive($valuesArray["active"]);
                    
                    
                  
                    array_push($this->careerList, $career);
                }
            
        }

    public function AddMySql(Career $career)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." ( careerId, description, active) VALUES ( :careerId, :description, :active);";
                
                
                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();
                
        
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
                $careerList = array();
        
                $query = "SELECT * FROM ".$this->tableName;
        
                $this->connection = Connection::GetInstance();
        
                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setCareerId($row["careerId"]);
                    $career->setDescription($row["description"]);
                    $career->setActive($row["active"]);
                   
        
                    array_push($careerList, $career);
                }
        
                return $careerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

   }
 ?>

