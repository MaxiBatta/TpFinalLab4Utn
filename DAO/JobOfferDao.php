<?php

namespace DAO;

use Models\JobOffer as JobOffer;
use \Exception as Exception;
use DAO\Connection as Connection;


class JobOfferDAO {

    private $jobOfferList = array();
    private $connection;
    private $tableName = "jobOffers";
    private $tableName1 = "jobPositions";
    private $tableName2 = "companies";
    private $tableNameInner = "joboffer_by_student";

    public function __construct() {
        $this->jobOfferList = array();
    }

    public function AddMySql(JobOffer $jobOffer) {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( dateTime, limitDate, state, companyId, jobPositionId) VALUES ( :dateTime, :limitDate, :state, :companyId, :jobPositionId);";

            $parameters["dateTime"] = $jobOffer->getDateTime();
            $parameters["limitDate"] = $jobOffer->getLimitDate();
            $parameters["state"] = $jobOffer->getState();
            $parameters["companyId"] = $jobOffer->getCompanyId();
            $parameters["jobPositionId"] = $jobOffer->getJobPositionId();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllMySql() {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function returnJobOfferById($id) {
        $jobOfferList = $this->GetAllMySql();

        foreach ($jobOfferList as $jobOffer) {
            if ($jobOffer->getJObOfferId() == $id) {
                return $jobOffer;
            }
        }

        return false;
    }

    public function SearchJobPosition($description) {

        try {
            $jobOfferList = array();

            $query = "SELECT * FROM .$this->tableName o  INNER JOIN .$this->tableName1 p  ON o.jobPositionId = p.jobPositionId WHERE description LIKE '%$description%'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetJobOfferById($jobOfferId) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->tableName . ".jobOfferId = :jobOfferId";

            $this->connection = Connection::GetInstance();

            $parameters['jobOfferId'] = $jobOfferId;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $newResultSet = $this->mapJobOfferData($resultSet);

                return $newResultSet[0];
            }

            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function mapJobOfferData($jobOffers) {
        $resp = array_map(function($p) {
            $jobOfferToAdd = new JobOffer();

            $jobOfferToAdd->setJobOfferId($p['jobofferid']);
            $jobOfferToAdd->setDateTime($p['datetime']);
            $jobOfferToAdd->setLimitDate($p['limitdate']);
            $jobOfferToAdd->setState($p['state']);
            $jobOfferToAdd->setCompanyId($p['companyid']);
            $jobOfferToAdd->setJobPositionId($p['jobpositionid']);
            $jobOfferToAdd->setStudentId($p['studentid']);

            return $jobOfferToAdd;
        }, $jobOffers);

        return $resp;
    }

    public function UpdateJobOffer($jobOfferId, JobOffer $newJobOffer) {
        try {
            $query = "UPDATE " . $this->tableName . " SET dateTime = :dateTime, limitDate = :limitDate, state = :state, jobPositionId = :jobPositionId, companyId = :companyId, studentId = :studentId, state = :state WHERE (jobOfferId = :jobOfferId);";

            $this->connection = Connection::GetInstance();

            $parameters["jobOfferId"] = $jobOfferId;
            $parameters["dateTime"] = $newJobOffer->getDateTime();
            $parameters["limitDate"] = $newJobOffer->getLimitDate();
            $parameters["state"] = $newJobOffer->getState();
            $parameters["companyId"] = $newJobOffer->getCompanyId();
            $parameters["jobPositionId"] = $newJobOffer->getJobPositionId();
            $parameters["studentId"] = $newJobOffer->getStudentId();

            $cantRows = $this->connection->ExecuteNonQuery($query, $parameters);

            return $cantRows;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    
    public function ApplyJobOffer($studentId, $jobOfferId, $postulationDate) {
        try {
            $query = "INSERT INTO " . $this->tableNameInner . " ( studentId, jobOfferId, postulationDate) VALUES ( :studentid, :jobofferid, :postulationdate);";

            $parameters["studentid"] = $studentId;
            $parameters["jobofferid"] = $jobOfferId;
            $parameters["postulationdate"] = $postulationDate;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function GetJobOfferByCompanyIdMySql($companyId) {
        try {
            $jobOfferList = array();

            $query = "SELECT * FROM $this->tableName WHERE companyId = '$companyId'";

            $this->connection = Connection::GetInstance();

            

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
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
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
?>

