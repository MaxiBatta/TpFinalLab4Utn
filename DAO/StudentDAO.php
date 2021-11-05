<?php

namespace DAO;

use DAO\IStudentDAO as IStudentDAO;
use Models\Student as Student;
use \Exception as Exception;
use DAO\Connection as Connection;

class StudentDAO implements IStudentDAO {

    private $studentList = array();
    private $connection;
    private $tableName = "students";

    public function Add(Student $student) {
        $this->RetrieveData();

        array_push($this->studentList, $student);

        $this->SaveData();
    }

    public function GetAll() {
        $this->RetrieveData();

        return $this->studentList;
    }

    private function SaveData() {
        $arrayToEncode = array();

        foreach ($this->studentList as $student) {
            $valuesArray["studentId"] = $student->getStudentId();
            $valuesArray["careerId"] = $student->getCareerId();
            $valuesArray["firstName"] = $student->getFirstName();
            $valuesArray["lastName"] = $student->getLastName();
            $valuesArray["dni"] = $student->getDni();
            $valuesArray["fileNumber"] = $student->getFileNumber();
            $valuesArray["gender"] = $student->getGender();
            $valuesArray["birthDate"] = $student->getBirthDate();
            $valuesArray["email"] = $student->getEmail();
            $valuesArray["phoneNumber"] = $student->getPhoneNumber();
            $valuesArray["active"] = $student->active();

            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents('Data/students.json', $jsonContent);
    }

    public function RetrieveDataFromApi() {
        $this->studentList = array();

        $apiStudent = curl_init(API_URL . 'Student');

        curl_setopt($apiStudent, CURLOPT_HTTPHEADER, array('x-api-key: ' . API_KEY));
        curl_setopt($apiStudent, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($apiStudent);

        $arrayToDecode = json_decode($response, true);

        foreach ($arrayToDecode as $valuesArray) {
            $student = new Student();
            $student->setStudentId($valuesArray["studentId"]);
            $student->setCareerId($valuesArray["careerId"]);
            $student->setFirstName($valuesArray["firstName"]);
            $student->setLastName($valuesArray["lastName"]);
            $student->setDni($valuesArray["dni"]);
            $student->setFileNumber($valuesArray["fileNumber"]);
            $student->setGender($valuesArray["gender"]);
            $student->setBirthDate($valuesArray["birthDate"]);
            $student->setEmail($valuesArray["email"]);
            $student->setPhoneNumber($valuesArray["phoneNumber"]);
            $student->setActive($valuesArray["active"]);

            array_push($this->studentList, $student);
        }

        try {
            foreach ($this->studentList as $student) {
                $query = "INSERT INTO " . $this->tableName . " ( studentId, careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, active) VALUES ( :studentId, :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :active)";

                $parameters["studentId"] = $student->getStudentId();
                $parameters["careerId"] = $student->getCareerId();
                $parameters["firstName"] = $student->getFirstName();
                $parameters["lastName"] = $student->getLastName();
                $parameters["dni"] = $student->getDni();
                $parameters["fileNumber"] = $student->getFileNumber();
                $parameters["gender"] = $student->getGender();
                $parameters["birthDate"] = $student->getBirthDate();
                $parameters["email"] = $student->getEmail();
                $parameters["phoneNumber"] = $student->getPhoneNumber();
                $parameters["active"] = $student->getActive();

                $this->connection = Connection::getInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            return 1;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return true;
    }

    public function UpdateStudent($studentId, Student $newStudent) {
        try
        {
            $query = "UPDATE " . $this->tableName . " SET careerId = :careerId, firstName = :firstName, lastName = :lastName, dni = :dni, fileNumber = :fileNumber, gender = :gender, birthDate = :birthDate, email = :email, phoneNumber = :phoneNumber, active = :active WHERE (studentId = :studentId);";

            $this->connection = Connection::GetInstance();
            
            $parameters["studentId"] = $studentId;
            $parameters["careerId"] = $newStudent->getCareerId();
            $parameters["firstName"] = $newStudent->getFirstName();
            $parameters["lastName"] = $newStudent->getLastName();
            $parameters["dni"] = $newStudent->getDni();
            $parameters["fileNumber"] = $newStudent->getFileNumber();
            $parameters["gender"] = $newStudent->getGender();
            $parameters["birthDate"] = $newStudent->getBirthDate();
            $parameters["email"] = $newStudent->getEmail();
            $parameters["phoneNumber"] = $newStudent->getPhoneNumber();
            $parameters["active"] = $newStudent->getActive();
            
            $cantRows = $this->connection->ExecuteNonQuery($query,$parameters);

            return $cantRows;

        }
        catch(PDOException $e)
        {
            throw new PDOException($e->getMessage());
        }
    } 

    /// Base de datos

    public function AddMySql(Student $student) {
        try {
            $query = "INSERT INTO " . $this->tableName . " ( careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, active) VALUES ( :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :active)";

            $parameters["careerId"] = $student->getCareerId();
            $parameters["firstName"] = $student->getFirstName();
            $parameters["lastName"] = $student->getLastName();
            $parameters["dni"] = $student->getDni();
            $parameters["fileNumber"] = $student->getFileNumber();
            $parameters["gender"] = $student->getGender();
            $parameters["birthDate"] = $student->getBirthDate();
            $parameters["email"] = $student->getEmail();
            $parameters["phoneNumber"] = $student->getPhoneNumber();
            $parameters["active"] = $student->getActive();

            $this->connection = Connection::getInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

            return "Usuario creado con éxito!";
        } catch (Exception $ex) {
            return "Ha ocurrido un error" . $ex->getMessage();
        }
    }

    public function GetAllMySql() {
        try {
            $studentList = array();

            $query = "SELECT * FROM " . $this->tableName;

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
                $student->setPhoneNumber($row["phonenumber"]);
                $student->setActive($row["active"]);

                array_push($studentList, $student);
            }

            return $studentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetStudentByMail($email) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->tableName . ".email = :email";

            $this->connection = Connection::GetInstance();

            $parameters['email'] = $email;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $newResultSet = $this->mapStudentData($resultSet);

                return $newResultSet[0];
            }

            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function GetStudentById($studentId) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE " . $this->tableName . ".studentId = :studentId";

            $this->connection = Connection::GetInstance();

            $parameters['studentId'] = $studentId;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $newResultSet = $this->mapStudentData($resultSet);

                return $newResultSet[0];
            }

            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function checkStudentByMail($email) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE email = :email";

            $this->connection = Connection::GetInstance();

            $parameters['email'] = $email;

            $resultSet = $this->connection->Execute($query, $parameters);

            if ($resultSet) {
                $_SESSION["existingMail"] = 1;
                return false;
            }

            return true;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function mapStudentData($students) {
        $resp = array_map(function($p) {
            $studentToAdd = new Student();

            $studentToAdd->setStudentId($p['studentid']);
            $studentToAdd->setCareerId($p['careerid']);
            $studentToAdd->setFirstName($p['firstname']);
            $studentToAdd->setLastName($p['lastname']);
            $studentToAdd->setDni($p['dni']);
            $studentToAdd->setFileNumber($p['filenumber']);
            $studentToAdd->setGender($p['gender']);
            $studentToAdd->setBirthDate($p['birthdate']);
            $studentToAdd->setEmail($p['email']);
            $studentToAdd->setPhoneNumber($p['phonenumber']);
            $studentToAdd->setActive($p['active']);

            return $studentToAdd;
        }, $students);

        return $resp;
    }

    public function SearchStudentMySql($dni) {
        try
        {
            $studentList = array();
    
            $query = "SELECT * FROM .$this->tableName  WHERE dni LIKE '%$dni%'" ;
    
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
                $student->setPhoneNumber($row["phonenumber"]);
                $student->setActive($row["active"]);

                array_push($studentList, $student);
            }

            return $studentList;
    
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
}
}

?>