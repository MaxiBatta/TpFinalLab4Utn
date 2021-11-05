<?php
    namespace Controllers;
    
    use DAO\Connection as Connection;
    use DAO\StudentDAO as StudentDAO;
    use DAO\CareerDAO as CareerDAO;
    use DAO\JobPositionDAO as JobPositionDAO;
    
    class DataController {
        
        public function getAllData () {
            $studentDAO = new StudentDAO();
            $careerDAO = new CareerDAO();
            $jobPositionDAO = new JobPositionDAO();
            
            $resp = $studentDAO->RetrieveDataFromApi();
            $resp2 = $careerDAO->RetrieveDataFromApi();
            $resp3 = $jobPositionDAO->RetrieveDataFromApi();
            
            if($resp == 1 && $resp2 == 1 && $resp3 == 1) {
                $_SESSION["dbState"] = 1;
            }
            else {
                $_SESSION["dbState"] = 0;
                $_SESSION["dbFailMessage"] = ($resp != 1 ? $resp : "");
                $_SESSION["dbFailMessage"] .= ($resp2 != 1 ? $resp2 : "");
                $_SESSION["dbFailMessage"] .= ($resp3 != 1 ? $resp3 : "");
            }
            require_once(VIEWS_PATH."admin-panel.php");
        }
        
    }
?>
