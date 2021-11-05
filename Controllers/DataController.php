<?php
    namespace Controllers;
    
    use DAO\Connection as Connection;
    use DAO\CareerDAO as CareerDAO;
    use DAO\StudentDAO as StudentDAO;
    
    class DataController {
        
        public function getAllData () {
            $studentDAO = new StudentDAO();
//            $careerDAO = new CareerDAO();
//            $jobPositionDAO = new CareerDAO();
            
            $resp = $studentDAO->RetrieveDataFromApi();
//            $resp2 = $careerDAO->RetrieveDataFromApi();
//            $resp3 = $jobPositionDAO->RetrieveDataFromApi();
            
//            if($resp == 1 && $resp2 == 1 && $resp3 == 1) {
            if($resp == 1) {
                $_SESSION["dbState"] = 1;
            }
            else {
                $_SESSION["dbState"] = 0;
                $_SESSION["dbFailMessage"] = $resp != 1 ? $resp : "";
//                $_SESSION["dbFailMessage"] .= $resp2 != 1 ? $resp : "";
//                $_SESSION["dbFailMessage"] .= $resp3 != 1 ? $resp : "";
            }
            require_once(VIEWS_PATH."admin-panel.php");
        }
        
    }
?>
