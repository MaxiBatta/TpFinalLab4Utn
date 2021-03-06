<?php

namespace DAO;

use Models\JobOfferByStudent as JobOfferByStudent;
use Models\Student as Student;
use Models\JobOffer as JobOffer;
use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\JobOfferDAO as JobOfferDAO;

class JobOfferByStudentDAO {

    private $jobOfferByStudentList = array();
    private $connection;
    private $tableName = "joboffer_by_student";
    private $tableStudent = "students";
    private $tableJobOffer = "joboffers";

    public function __construct() {
        $this->jobOfferByStudentList = array();
    }

    public function GetAll() {
        $this->RetrieveData();

        return $this->jobOfferByStudentList;
    }

    public function AddMySql(JobOfferByStudent $jobOfferByStudent) {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( studentId, jobOfferId, postulationDate, mailSent, active) VALUES ( :studentId, :jobOfferId, :postulationDate, :mailSent, :active);";

            $parameters["studentId"] = $jobOfferByStudent->getStudentId();
            $parameters["jobOfferId"] = $jobOfferByStudent->getJobOfferId();
            $parameters["postulationDate"] = $jobOfferByStudent->getPostulationDate();
            $parameters["mailSent"] = $jobOfferByStudent->getMailSent();
            $parameters["active"] = $jobOfferByStudent->getActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllMySql() {
        try {
            $jobOfferByStudentList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobOfferByStudent = new JobOfferByStudent();
                $jobOfferByStudent->setJobOfferByStudentId($row["jobofferbystudentid"]);
                $jobOfferByStudent->setStudentId($row["studentid"]);
                $jobOfferByStudent->setJobOfferId($row["jobofferid"]);
                $jobOfferByStudent->setPostulationDate($row["postulationdate"]);
                $jobOfferByStudent->setMailSent($row["mailsent"]);
                $jobOfferByStudent->setActive($row["active"]);

                array_push($jobOfferByStudentList, $jobOfferByStudent);
            }

            return $jobOfferByStudentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllStudentsByJobOffer($jobOfferId) {

        try {
            $studentList = array();

            $query = "SELECT * FROM .$this->tableName jxs INNER JOIN .$this->tableStudent s ON jxs.studentId = s.studentId WHERE jxs.jobofferid = $jobOfferId";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $student = new Student();
                $student->setStudentId($row["studentid"]);
                $student->setCareerId($row["careerid"]);
                $student->setFirstName($row["firstname"]);
                $student->setLastName($row["lastname"]);
                $student->setDni($row["dni"]);
                $student->setFileNumber($row["filenumber"]);
                $student->setGender($row["gender"]);
                $student->setBirthDate($row["birthdate"]);
                $student->setEmail($row["email"]);
                $student->setActive($row["active"]);

                array_push($studentList, $student);
            }

            return $studentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAllJobOffersByStudent($studentId) {

        try {
            $jobOffersList = array();

            $query = "SELECT * FROM .$this->tableName jxs INNER JOIN .$this->tableJobOffer jo ON jxs.jobOfferId = jo.jobOfferId WHERE jxs.studentId = $studentId AND jxs.active = 1";

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

                array_push($jobOffersList, $jobOffer);
            }

            return $jobOffersList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function GetJobOffersByStudentByStudent($studentId) {
        try {
            $jobOfferByStudentList = array();

            $query = "SELECT * FROM $this->tableName jxs WHERE jxs.studentId = $studentId";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobOfferByStudent = new JobOfferByStudent();
                $jobOfferByStudent->setStudentId($row["studentid"]);
                $jobOfferByStudent->setJobOfferId($row["jobofferid"]);
                $jobOfferByStudent->setPostulationDate($row["postulationdate"]);
                $jobOfferByStudent->setMailSent($row["mailsent"]);
                $jobOfferByStudent->setActive($row["active"]);

                array_push($jobOfferByStudentList, $jobOfferByStudent);
            }

            return $jobOfferByStudentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function returnJobOfferByStudentByJobOfferId($jobOfferId) {
        $jobOfferByStudentList = $this->GetAllMySql();

        foreach ($jobOfferByStudentList as $jobOfferByStudent) {
            if ($jobOfferByStudent->getJobOfferId() == $jobOfferId) {
                return $jobOfferByStudent;
            }
        }

        return false;
    }
    
    public function GetAllJobOffersById($jobOfferId) {
        try {
            $jobOfferByStudentList = array();

            $query = "SELECT * FROM " . $this->tableName . " j WHERE j.jobofferid = " . $jobOfferId . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {
                $jobOfferByStudent = new JobOfferByStudent();
                $jobOfferByStudent->setStudentId($row["studentid"]);
                $jobOfferByStudent->setJobOfferId($row["jobofferid"]);
                $jobOfferByStudent->setPostulationDate($row["postulationdate"]);
                $jobOfferByStudent->setMailSent($row["mailsent"]);
                $jobOfferByStudent->setActive($row["active"]);

                array_push($jobOfferByStudentList, $jobOfferByStudent);
            }

            return $jobOfferByStudentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function modifyMailSent($jobOfferByStudentId, $mailSent) {
        try {
            $query = "UPDATE " . $this->tableName . " SET mailsent = :mailSent WHERE jobofferbystudentid = :jobOfferByStudentId;";

            $this->connection = Connection::GetInstance();

            $parameters['jobOfferByStudentId'] = $jobOfferByStudentId;
            $parameters["mailSent"] = $mailSent;

            $cantRows = $this->connection->ExecuteNonQuery($query, $parameters);

            return $cantRows;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function UpdateActiveJobOfferByStudent($postulationId, $active){
        try {
            $query = "UPDATE " . $this->tableName . " SET active = :active WHERE jobofferbystudentid = :postulationId;";

            $this->connection = Connection::GetInstance();

            $parameters['postulationId'] = $postulationId;
            $parameters["active"] = $active;

            $cantRows = $this->connection->ExecuteNonQuery($query, $parameters);

            return $cantRows;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function returnJobPositionByIdPostulationDate($postulationDate) {
        $jobOfferByStudentList = $this->GetAllMySql();

        foreach ($jobOfferByStudentList as $jobOfferByStudent) {
            if ($jobOfferByStudent->getPostulationDate() == $postulationDate) {
                return $jobOfferByStudent;
            }
        }

        return false;
    }
    
    public function GetJobOfferByJobOfferIdAndStudentId($jobOfferId, $studentId) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE jobofferid = :jobOfferId AND studentid = :studentId";

            $this->connection = Connection::GetInstance();

            $parameters['jobOfferId'] = $jobOfferId;
            $parameters['studentId'] = $studentId;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $newResultSet = $this->mapJobOfferByStudentData($resultSet);

                return $newResultSet[0];
            }

            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    public function mapJobOfferByStudentData($jobOffersByStudent) {
        $resp = array_map(function($p) {
            $jobOfferByStudentToAdd = new JobOfferByStudent();

            $jobOfferByStudentToAdd->setJobOfferByStudentId($p['jobofferbystudentid']);
            $jobOfferByStudentToAdd->setStudentId($p['studentid']);
            $jobOfferByStudentToAdd->setJobOfferId($p['jobofferid']);
            $jobOfferByStudentToAdd->setPostulationDate($p['postulationdate']);
            $jobOfferByStudentToAdd->setMailSent($p['mailsent']);
            $jobOfferByStudentToAdd->setActive($p['active']);

            return $jobOfferByStudentToAdd;
        }, $jobOffersByStudent);

        return $resp;
    }
}
?>

