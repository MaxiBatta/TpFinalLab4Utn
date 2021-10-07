<?php
    namespace Models;

    use Models\Person as Person;

    class Administrator extends Person
    {
       
        private $email;
       

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }
        
    }
?>
