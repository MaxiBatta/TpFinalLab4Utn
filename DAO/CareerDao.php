<?php

namespace DAO;

use Models\Career as Career;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\CareerDAO as CareerDAO;
use DAO\StudentDAO as StudentDAO;

class CareerDAO {

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

    private function RetrieveData() {
        $this->careerList = array();

        $apiCareer = curl_init(API_URL . 'Career');

        curl_setopt($apiCareer, CURLOPT_HTTPHEADER, array('x-api-key: ' . API_KEY));
        curl_setopt($apiCareer, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiCareer);

        $arrayToDecode = json_decode($response, true);

        foreach ($arrayToDecode as $valuesArray) {
            $career = new Career();
            $career->setCareerId($valuesArray["careerId"]);
            $career->setDescription($valuesArray["description"]);
            $career->setActive($valuesArray["active"]);



            array_push($this->careerList, $career);
        }
    }
    
    public function RetrieveDataFromApi() {
        $this->careerList = array();

        $apiCareer = curl_init(API_URL . 'Career');

        curl_setopt($apiCareer, CURLOPT_HTTPHEADER, array('x-api-key: ' . API_KEY));
        curl_setopt($apiCareer, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiCareer);

        $arrayToDecode = json_decode($response, true);

        foreach ($arrayToDecode as $valuesArray) {
            $career = new Career();
            $career->setCareerId($valuesArray["careerId"]);
            $career->setDescription($valuesArray["description"]);
            $career->setActive($valuesArray["active"]);

            array_push($this->careerList, $career);
        }

        try {
            foreach ($this->careerList as $career) {
                $query = "INSERT INTO " . $this->tableName . " ( careerId, description, active) VALUES ( :careerId, :description, :active);";
                
                $parameters["careerId"] = $career->getCareerId();
                $parameters["description"] = $career->getDescription();
                $parameters["active"] = $career->getActive();
                
                $this->connection = Connection::getInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            return 1;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return true;
    }
    
    public function AddMySql(Career $career) {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( careerId, description, active) VALUES ( :careerId, :description, :active);";


            $parameters["careerId"] = $career->getCareerId();
            $parameters["description"] = $career->getDescription();
            $parameters["active"] = $career->getActive();


            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllMySql() {
        try {
            $careerList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $career = new Career();
                $career->setCareerId($row["careerid"]);
                $career->setDescription($row["description"]);
                $career->setActive($row["active"]);

                array_push($careerList, $career);
            }

            return $careerList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function GetCareerByStudent($careerId) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " c INNER JOIN students s WHERE c.careerid = :careerId";

            $this->connection = Connection::GetInstance();

            $parameters['careerId'] = $careerId;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $careerDAO = new CareerDAO();
                $newResultSet = $careerDAO->mapCareerData($resultSet);

                return $newResultSet[0];
            }

            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function mapCareerData($career) {
        $resp = array_map(function($p) {
            $careerToAdd = new Career();

            $careerToAdd->setCareerId($p['careerid']);
            $careerToAdd->setDescription($p['description']);
            $careerToAdd->setActive($p['active']);

            return $careerToAdd;
        }, $career);

        return $resp;
    }
}
?>

