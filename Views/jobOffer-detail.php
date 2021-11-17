<?php
require_once('nav.php');

if (!$actual_jobOffer) {
    echo '<h4 class="text-danger">Ha ocurrido un error, la oferta no ha podido identificarse correctamente.</h4>';
}

$appliedJob = false;

if (isset($_SESSION["jobOffer_applied_student"]) && $_SESSION["jobOffer_applied_student"]) {
    $studentName = $_SESSION["activeStudent"]->getFirstName() . " " . $_SESSION["activeStudent"]->getLastName();
    $studentDni = $_SESSION["activeStudent"]->getDni();
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
            <div class="row mt-3">
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
                <div class="col-md-10 text-right">
                    <form action="<?= FRONT_ROOT ?>JobOffer/ApplyJob" method="get">
                        <input type="hidden" name="studentId" value="<?= $_SESSION["activeStudent"]->getStudentId() ?>">
                        <input type="hidden" name="jobOfferId" value="<?= $actual_jobOffer->getJobOfferId() ?>">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-danger" <?= $appliedJob ? "disabled='disabled'" . " title='Usted ya se encuentra inscripto a esta oferta laboral'" : "" ?>>¡Me postulo!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</main>
