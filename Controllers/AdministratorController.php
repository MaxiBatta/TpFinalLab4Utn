<?php
    namespace Controllers;

    use Models\Administrator as Administrator;
    use Utils\Utils as Utils;
    use Controllers\StudentController as StudentController;
    use Controllers\CareerController as CareerController;
    use DAO\StudentDao as StudentDAO;
    use DAO\CareerDao as CareerDAO;
    use DAO\CompanyDao as CompanyDao;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\JobOfferByStudentDAO as JobOfferByStudentDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    
    
    class AdministratorController
    {
        public function __construct()
        {
            
        }
        
        public function ShowPanelView($message = '')
        {
            Utils::CheckAdmin();
            require_once(VIEWS_PATH."admin-panel.php");
        }

        public function ShowOffersCatalogueView($message = '')
        {
            require_once(VIEWS_PATH."jobOffer-list-catalogue-admin.php");
        }
        
        public function ShowAdminStudentModifyView($id) {
            Utils::CheckAdmin();
            
            $studentDAO = new StudentDAO();
            $toModifyStudent = $studentDAO->GetStudentById($id);
            
            $careerDAO = new CareerDAO();
            $career = $careerDAO->GetCareerByStudent($toModifyStudent->getCareerId()); 
            
            $jobOfferByStudentDAO = new JobOfferByStudentDAO();
            $jobOffersList = $jobOfferByStudentDAO->GetAllJobOffersByStudent($id);
            
            $companyDAO = new CompanyDao();
            $companyList= $companyDAO->GetAllMySql();

            $jobPositionDAO = new JobPositionDAO();
            $jobPositionList= $jobPositionDAO->GetAllMySql();
            
            $jobOfferByStudentDAO2 = new JobOfferByStudentDAO();
            $jobOfferByStudentPostulationDates = $jobOfferByStudentDAO2->GetJobOffersByStudentByStudent($id);
            
            if ($_GET) {
                $_SESSION["toModifyStudent"] = $id;
                require_once(VIEWS_PATH . "student-modify-admin.php");
            }
            else {
                $_SESSION["modifyError"] = 1;
                require_once(VIEWS_PATH . "admin-panel.php");
            }
        }
        
       
    }
?>