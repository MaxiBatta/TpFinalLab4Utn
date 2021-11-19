<?php
    require_once('./Utils/FPDF/fpdf.php');
    use FPDF\fpdf as FPDF;
    use DAO\StudentDAO as StudentDAO;
    use DAO\JobOfferDAO as JobOfferDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JobOfferByStudenDao as JobOfferByStudentDao;
    use DAO\JobPositionDAO as JobPositionDAO;
    use DAO\CareerDAO as CareerDAO;
    use Models\JobOffer as JobOffer;
    use Models\Student as Student;
    use Models\Postulation as Postulation;
    
           
    class PdfController
    {
        private $Pdf;
        private $JobOfferByStudentDao;
        private $studentDAO;
        private $jobOfferDAO;
        private $companyDAO;
        private $jobPositionDAO;
        private $careerDAO;

        public function __construct()
        {
            $this->JobOfferByStudentDao = new JobOfferByStudentDao();
            $this->studentDAO = new StudentDAO();
            $this->jobOfferDAO = new JobOfferDAO();
            $this->companyDAO = new CompanyDAO();
            $this->jobPositionDAO = new JobPositionDAO();
            $this->careerDAO = new CareerDAO();
            $this->Pdf = new FPDF();
        }

        public function getPdf($jobOfferId)
        {
            ///$jobOffer= $this->jobOfferDAO->GetJobOfferById($jobOfferId);
            ///$studentList = $this->JobOfferByStudent->GetAllStudentsByJobOffer($jobOfferId);
            ///$company = $this->companyDAO->GetCompanyByIdMySql($jobOffer->getCompanyId());
            $studentList= $this->studentDAO->GetJobOfferById();


            if (!$studentList) {
                return;
            }
            
            $this->Pdf->AliasNbPages();
            $this->Pdf->AddPage();
            $this->Pdf->SetFont('Arial','',16);

            foreach ($studentList as $student) {
                $this->Pdf->Cell(40, 10, $student->getName(), '1', '0', 'C', '0');
            }

            $this->Pdf->Output();
        }
    }
?>