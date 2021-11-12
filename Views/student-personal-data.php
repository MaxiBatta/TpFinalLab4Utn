<?php
require_once('nav.php');

use DAO\CareerDAO as CareerDAO;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container bg-light-alpha p-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4"><?= $_SESSION["activeStudent"]->getFirstName() . " " . $_SESSION["activeStudent"]->getLastName(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Nombre</label>
                    <h5><?= $_SESSION["activeStudent"]->getFirstName() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Apellido</label>
                    <h5><?= $_SESSION["activeStudent"]->getLastName() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>DNI</label>
                    <h5><?= $_SESSION["activeStudent"]->getDni() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Fecha de Nacimiento</label>
                    <h5><?= date('Y-m-d H:i:s', strtotime($_SESSION["activeStudent"]->getBirthDate())) ?></h5>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <label>Género</label>
                    <h5><?= $_SESSION["activeStudent"]->getGender() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Número de Teléfono</label>
                    <h5><?= $_SESSION["activeStudent"]->getPhoneNumber() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Correo</label>
                    <h5><?= $_SESSION["activeStudent"]->getEmail() ?></h5>
                </div>
            </div>
            <hr>
            <div id="accordion">
                <div class="card" style="background-color: #fff0">
                    <div id="aditional_data_heading">
                        <h6 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#aditional_data" aria-expanded="true" aria-controls="aditional_data">
                                <strong>Datos Adicionales</strong>
                            </button>
                        </h6>
                    </div>

                    <div id="aditional_data" class="collapse" aria-labelledby="aditional_data_heading" data-parent="#accordion">
                        <div class="card-body" style="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Carrera</label>
                                    <h5>
                                        <?php
                                        $_SESSION["activeStudent"]->getCareerId();
                                        $careerDAO = new CareerDAO();
                                        $careersList = $careerDAO->GetAllMySql();

                                        foreach ($careersList as $key => $value) {
                                            if ($_SESSION["activeStudent"]->getCareerId() == $value->getCareerId()) {
                                                echo $value->getDescription();
                                            }
                                        }
                                        ?>
                                    </h5>
                                </div>
                                <div class="col-md-3">
                                    <label>Número de expediente</label>
                                    <h5><?= $_SESSION["activeStudent"]->getFileNumber() ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <label>Id del estudiante</label>
                                    <h5><?= $_SESSION["activeStudent"]->getStudentId() ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $jobOfferDAO = new JobOfferDAO();
            $jobOfferList = $jobOfferDAO->GetAllMySql();

            foreach ($jobOfferList as $key => $jobOffer) {
                if ($jobOffer->getStudentId() == $_SESSION["activeStudent"]->getStudentId()) {
                    $jobPositionDAO = new JobPositionDAO();
                    $jobPositionList = $jobPositionDAO->GetAllMySql();

                    foreach ($jobPositionList as $key => $jobPosition) {
                        if ($jobPosition->getJobPositionId() == $jobOffer->getJobPositionId()) {

                            $jobPositionDescription = $jobPosition->getDescription();

                            $companyDAO = new CompanyDAO();
                            $companyList = $companyDAO->GetAllMySql();

                            foreach ($companyList as $key => $company) {
                                if ($company->getCareerId() == $jobPosition->getCareerId()) {
                                    $companyDescription = $company->getDescription();
                                }
                            }
                        }
                    }
                    ?>
                    <hr>
                    <div id="accordion" class="mt-3">
                        <div class="card" style="background-color: #fff0">
                            <div id="aditional_data_heading">
                                <h6 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#aditional_data" aria-expanded="true" aria-controls="aditional_data">
                                        <strong>Datos Adicionales</strong>
                                    </button>
                                </h6>
                            </div>
                            <div id="job_offer" class="collapse" aria-labelledby="job_offer_heading" data-parent="#accordion">
                                <div class="card-body" style="">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Empresa actual</label>
                                            <h5>
                                                <?= $companyDescription ?>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Puesto laboral actual</label>
                                            <h5>
                                                <?= $jobPositionDescription?>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Número de expediente</label>
                                            <h5><?= $_SESSION["activeStudent"]->getFileNumber() ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Id del estudiante</label>
                                            <h5><?= $_SESSION["activeStudent"]->getStudentId() ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="row mt-3">
                <div class="col-md-12 text-right">
                    <a href="<?php echo FRONT_ROOT . 'Student/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                </div>
            </div>
        </div>


    </section>
</main>