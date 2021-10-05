<?php
    namespace Models;

    use Models\Person as Person;

    class Student extends Person
    {
        private $dni;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $email;
        private $phoneNumber;
        private $active;


        public function getDni()
        {
            return $this->dni;
        }

        public function setDni($dni)
        {
            $this->dni = $dni;
        }

        public function getFileNumber()
        {
            return $this->fileNumber;
        }

        public function setFilenumber($fileNumber)
        {
            $this->fileNumber = $fileNumber;
        }

        public function getGender()
        {
            return $this->gender;
        }

        public function setGender($gender)
        {
            $this->gender= $gender;
        }

        public function getBirthDate()
        {
            return $this-> birthDate;
        }
        public function setBirthDate($birthDate)
        {
            $this->birthDate = $birthDate;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail ($email)
        {
            $this->email= $email;
        }
        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }
        public function setPhoneNumber($phoneNumber)
        {
            $this->phoneNumber= $phoneNumber;
        }
        public function getActive()
        {
            return $this->active;
        }
        public function setActive($active)
        {
            $this->active= $active;
        }
        
    }
?>

