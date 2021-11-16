<?php
require_once('nav.php');

if (!$actual_jobOffer) {
    echo '<h4 class="text-danger">Ha ocurrido un error, la oferta no ha podido identificarse correctamente.</h4>';
}

$appliedJob = false;

if (isset($_SESSION["jobOffer_applied_student"]) && $_SESSION["jobOffer_applied_student"]) {
    $studentName = $_SESSION["jobOffer_applied_student"]->getFirstName() . " " . $_SESSION["jobOffer_applied_student"]->getLastName();
    $studentDni = $_SESSION["jobOffer_applied_student"]->getDni();
    $appliedJob = true;
}

$jobPositionDescription = $_SESSION["jobOffer_position"]->getDescription();

$companyName = $_SESSION["jobOffer_company"]->getName();
$companyDescription = $_SESSION["jobOffer_company"]->getDescription();

unset($_SESSION["jobOffer_applied_student"]);
unset($_SESSION["jobOffer_position"]);
unset($_SESSION["jobOffer_company"]);

$back = FRONT_ROOT . 'JobOffer/ShowJobOffersCatalogueView';
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><?= $companyName ?></h2>
                            </div>
                            <div class="col-md-12">
                                <p><?= $companyDescription ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label>Puesto</label>
                                <h4><?= $jobPositionDescription ?></h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Fecha inicio</label>
                                <h5><?= $actual_jobOffer->getDateTime() ?></h5>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha limite</label>
                                <h5><?= $actual_jobOffer->getLimitDate() ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION["adminLogged"])) { ?>  
                <div id="accordion" class="mt-3">
                    <div class="card card-body">
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
                                    <div class="col-md-6">
                                        <label>Id Oferta Laboral</label>
                                        <h5><?= $actual_jobOffer->getJobOfferId() ?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Estado</label>
                                        <?= $actual_jobOffer->getState() == 1 ? '<h5 class="text-success">Activa</h5>' : '<h5 class="text-danger">Inactiva</h5>' ?>
                                    </div>
                                </div>
                                <?php if(isset($studentName)) { ?>
                                <hr>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label>Estudiante con el puesto aplicado</label>
                                            <h5><?= $studentName . " / " . $studentDni ?></h5>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row mt-3">
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
                <?php if (isset($_SESSION["studentLogged"])) { ?>
                    <div class="col-md-10 text-right">
                        <form action="<?= FRONT_ROOT ?>JobOffer/ApplyJob" method="get">
                            <input type="hidden" name="studentId" value="<?= $_SESSION["activeStudent"]->getStudentId() ?>">
                            <input type="hidden" name="jobOfferId" value="<?= $actual_jobOffer->getJobOfferId() ?>">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-danger" <?= $appliedJob ? "disabled='disabled'" . " title='Usted ya se encuentra inscripto a una oferta laboral'" : "" ?>>¡Me postulo!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

    </section>
</main>
