<?php

namespace DAO;

use Models\JobPosition as JobPosition;
use \Exception as Exception;
use DAO\Connection as Connection;

class JobPositionDAO {

    private $jobPositionList = array();
    private $connection;
    private $tableName = "jobPositions";
    private $tableName1 = "jobOffers";
    private $tableName2 = "companies";

    public function __construct() {
        $this->jobPositionList = array();
    }

    public function GetAll() {
        $this->RetrieveData();

        return $this->jobPositionList;
    }

    private function RetrieveData() {
        $this->jobPositionList = array();

        $apiJobPosition = curl_init(API_URL . 'JobPosition');

        curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array('x-api-key: ' . API_KEY));
        curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiJobPosition);

        $arrayToDecode = json_decode($response, true);

        foreach ($arrayToDecode as $valuesArray) {
            $jobPosition = new JobPosition();
            $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
            $jobPosition->setCareerId($valuesArray["careerId"]);
            $jobPosition->setDescription($valuesArray["description"]);

            array_push($this->jobPositionList, $jobPosition);
        }
    }

    public function RetrieveDataFromApi() {
        $this->jobPositionList = array();

        $apiJobPosition = curl_init(API_URL . 'JobPosition');

        curl_setopt($apiJobPosition, CURLOPT_HTTPHEADER, array('x-api-key: ' . API_KEY));
        curl_setopt($apiJobPosition, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiJobPosition);

        $arrayToDecode = json_decode($response, true);

        foreach ($arrayToDecode as $valuesArray) {
            $jobPosition = new JobPosition();
            $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
            $jobPosition->setCareerId($valuesArray["careerId"]);
            $jobPosition->setDescription($valuesArray["description"]);

            array_push($this->jobPositionList, $jobPosition);
        }

        try {
            foreach ($this->jobPositionList as $jobPosition) {
                $query = "INSERT INTO " . $this->tableName . " ( jobPositionId, careerId, description) VALUES ( :jobPositionId, :careerId, :description)";
                
                $parameters["jobPositionId"] = $jobPosition->getJobPositionId();
                $parameters["careerId"] = $jobPosition->getCareerId();
                $parameters["description"] = $jobPosition->getDescription();
                
                $this->connection = Connection::getInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            return 1;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return true;
    }

    public function AddMySql(JobPosition $jobPosition) {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( careerId, description) VALUES ( :careerId, :description);";

            $parameters["careerId"] = $jobPosition->getCareerId();
            $parameters["description"] = $jobPosition->getDescription();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllMySql() {
        try {
            $jobPositionList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row["jobpositionid"]);
                $jobPosition->setCareerId($row["careerid"]);
                $jobPosition->setDescription($row["description"]);

                array_push($jobPositionList, $jobPosition);
            }

            return $jobPositionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    public function returnJobPositionByIdMySql($id) {
        $jobPositionList = $this->GetAllMySql();

        foreach ($jobPositionList as $jobPosition) {
            if ($jobPosition->getJobPositionId() == $id) {
                return $jobPosition;
            }
        }

        return false;
    }

    public function GetJobPositionByCompanyIdMySql($companyId) {
        try {
            $jobPositionList = array();
            
            $query = "SELECT * FROM .$this->tableName p INNER JOIN .$this->tableName1 j ON p.jobPositionId = j.jobPositionId INNER JOIN .$this->tableName2 c ON j.companyId = c.companyId WHERE c.companyId = '$companyId'";

            $this->connection = Connection::GetInstance();

            
            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row["jobpositionid"]);
                $jobPosition->setCareerId($row["careerid"]);
                $jobPosition->setDescription($row["description"]);

                array_push($jobPositionList, $jobPosition);
            }

            return $jobPositionList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    

}

?>