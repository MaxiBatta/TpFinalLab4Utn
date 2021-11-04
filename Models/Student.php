<?php

namespace Models;

use Models\Person as Person;

class Student extends Person {

    private $studentId;
    private $careerId;
    private $firstName;
    private $lastName;
    private $dni;
    private $fileNumber;
    private $gender;
    private $birthDate;
    private $email;
    private $phoneNumber;
    private $active;

    public function getStudentId() {
        return $this->studentId;
    }

    public function setStudentId($studentId) {
        $this->studentId = $studentId;
    }

    public function getCareerId() {
        return $this->careerId;
    }

    public function setCareerId($careerId) {
        $this->careerId = $careerId;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getFileNumber() {
        return $this->fileNumber;
    }

    public function setFilenumber($fileNumber) {
        $this->fileNumber = $fileNumber;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }
}
?>

