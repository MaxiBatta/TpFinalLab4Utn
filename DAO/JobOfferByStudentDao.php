<?php

namespace DAO;

use Models\JobOfferByStudent as JobOfferByStudent;
use Models\Student as Student;
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
            $query = "INSERT INTO " . $this->tableName . " ( studentId, jobOfferId, postulationDate) VALUES ( :studentId, :jobOfferId, :postulationDate);";

            $parameters["studentId"] = $jobOfferByStudent->getStudentId();
            $parameters["jobOfferId"] = $jobOfferByStudent->getJobOfferId();
            $parameters["postulationDate"] = $jobOfferByStudent->getPostulationDate();

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
                $jobOfferByStudent->setStudentId($row["studentid"]);
                $jobOfferByStudent->setJobOfferId($row["jobofferid"]);
                $jobOfferByStudent->setPostulationDate($row["postulationdate"]);

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
    
    public function returnJobOfferByStudentByJobOfferId($jobOfferId) {
        $jobOfferByStudentList = $this->GetAllMySql();

        foreach ($jobOfferByStudentList as $jobOfferByStudent) {
            if ($jobOfferByStudent->getJobOfferId() == $jobOfferId) {
                return $jobOfferByStudent;
            }
        }

        return false;
    }
}
?>

