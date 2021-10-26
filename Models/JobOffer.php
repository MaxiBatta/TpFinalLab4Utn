<?php

namespace Models;

Class JobOffer {

    private $jobOfferId;
    private $dateTime;
    private $limitDate;
    private $state;
    
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
    
    public function setJobOfferId($jobOfferId) {
        $this->jobOfferId = $jobOfferId;
    }
    
    public function setDateTime($dateTime) {
        $this->dateTime = $dateTime;
    }

    public function setLimitDate($limitDate) {
        $this->limitDate = $limitDate;
    }

    public function setState($state) {
        $this->state = $state;
    }
}

?>