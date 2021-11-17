<?php

namespace Models;

Class JobOfferByStudent
{
    private $jobOfferByStudentId;
    private $studentId;
    private $jobOfferId;
    private $postulationDate;
    
    function __construct() {
        
    }
    
    function getJobOfferByStudentId() {
        return $this->jobOfferByStudentId;
    }

    function getStudentId() {
        return $this->studentId;
    }

    function getJobOfferId() {
        return $this->jobOfferId;
    }

    function getPostulationDate() {
        return $this->postulationDate;
    }

    function setJobOfferByStudentId($jobOfferByStudentId): void {
        $this->jobOfferByStudentId = $jobOfferByStudentId;
    }

    function setStudentId($studentId): void {
        $this->studentId = $studentId;
    }

    function setJobOfferId($jobOfferId): void {
        $this->jobOfferId = $jobOfferId;
    }

    function setPostulationDate($postulationDate): void {
        $this->postulationDate = $postulationDate;
    }


    
}



?>