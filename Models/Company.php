<?php
    namespace Models;


    class Company 
    {
        private $name;
        private $yearFoundation;
        private $city;
        private $description;
        private $logo;
        private $email;
        private $phoneNumber;


        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getYearFoundation()
        {
            return $this->yearFoundation;
        }

        public function setYearFoundation($yearFoundation)
        {
            $this->yearFoundation = $yearFoundation;
        }

        public function getCity()
        {
            return $this->city;
        }

        public function setCity($city)
        {
            $this->city= $city;
        }

        public function getDescription()
        {
            return $this-> description;
        }
        public function setDescription($description)
        {
            $this->description = $description;
        }
        public function getlogo()
        {
            return $this->logo;
        }
        public function setLogo($logo)
        {
            $this->logo= $logo;
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
        
        
    }
?>