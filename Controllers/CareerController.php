<?php

namespace Controllers;

use DAO\CareerDAO as CareerDAO;
use Models\Career as Career;
use Utils\Utils as Utils;


class CareerController {

    private $CareerDAO;

    public function __construct() {
        $this->careerDAO = new CareerDAO();
    }
    public function getAllInfo(){
        $careerList= $this->careerDAO->getAllMySql();
        return $careerList;
    }
}

?>