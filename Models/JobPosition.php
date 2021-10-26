<?php

namespace Models;

Class JobPosition {

    private $jobPositionId;
    private $careerId;
    private $description;
    
    function __construct() {
        
    }
    
    public function getJobPositionId() {
        return $this->jobPositionId;
    }
    
    public function getCareerId() {
        return $this->careerId;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setJobPositionId($jobPositionId) {
        $this->jobPositionId = $jobPositionId;
    }

    public function setCareerId($careerId) {
        $this->careerId = $careerId;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}

?>