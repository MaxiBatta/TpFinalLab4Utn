<?php

namespace Models;

Class JobOffer {

    private $jobOfferId;
    private $dateTime;
    private $limitDate;
    private $state;
    private $companyId;
    private $jobPositionId;
    private $studentId;
    
    function __construct() {
        
    }
    
    public function getJobOfferId() {
        return $this->jobOfferId;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getLimitDate() {
        return $this->limitDate;
    }

    public function getState() {
        return $this->state;
    }

    public function getCompanyId() {
        return $this->companyId;
    }

    public function getJobPositionId() {
        return $this->jobPositionId;
    }

    public function getStudentId() {
        return $this->studentId;
    }

    public function setJobOfferId($jobOfferId): void {
        $this->jobOfferId = $jobOfferId;
    }

    public function setDateTime($dateTime): void {
        $this->dateTime = $dateTime;
    }

    public function setLimitDate($limitDate): void {
        $this->limitDate = $limitDate;
    }

    public function setState($state): void {
        $this->state = $state;
    }

    public function setCompanyId($companyId): void {
        $this->companyId = $companyId;
    }

    public function setJobPositionId($jobPositionId): void {
        $this->jobPositionId = $jobPositionId;
    }

    public function setStudentId($studentId): void {
        $this->studentId = $studentId;
    }
}

?>