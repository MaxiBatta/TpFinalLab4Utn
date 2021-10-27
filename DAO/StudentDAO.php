<?php
    namespace DAO;

    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();
        private $connection;
        private $tableName = "students";

        public function Add(Student $student)
        {
            $this->RetrieveData();
            
            array_push($this->studentList, $student);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->studentList as $student)
            {
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

        private function RetrieveData()
        {
            $this->studentList = array();

            $apiStudent = curl_init(API_URL .'Student');

            curl_setopt($apiStudent, CURLOPT_HTTPHEADER, array('x-api-key: '.API_KEY));
            curl_setopt($apiStudent, CURLOPT_RETURNTRANSFER, true);
                    
            $response = curl_exec($apiStudent);

            $arrayToDecode = json_decode($response, true);

            foreach($arrayToDecode as $valuesArray)
                {
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
            
        }

        /// Base de datos

public function AddMySql(Student $student)
{
    try
    {
        $query = "INSERT INTO ".$this->tableName." ( careerId, dni, fileNumber, gender, birthDate, email, phoneNumber,active) VALUES ( :carrerId, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :active);";
        
        
        $parameters["careerId"] = $student->getCareerId();
        $parameters["dni"] = $student->getDni();
        $parameters["fileNumber"] = $student->getFileNumber();
        $parameters["gender"] = $student->getGender();
        $parameters["birthDate"] = $student->getBirthDate();
        $parameters["email"] = $student->getEmail();
        $parameters["phoneNumber"] = $student->getPhoneNumber();
        $parameters["active"] = $student->getActive();

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
        $studentList = array();

        $query = "SELECT * FROM ".$this->tableName;

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);
        
        foreach ($resultSet as $row)
        {                
            $student = new Student();
            $student->setStudentId($row["studentId"]);
            $student->setCareerId($row["careerId"]);
            $student->setDni($row["dni"]);
            $student->setFileNumber($row["fileNumber"]);
            $student->setGender($row["gender"]);
            $student->setBirthDate($row["birthDate"]);
            $student->setEmail($row["email"]);
            $student->setPhoneNumber($row["phoneNumber"]);
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