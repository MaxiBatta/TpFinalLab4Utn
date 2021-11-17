<?php
require_once('nav.php');

if (!$actual_jobOffer) {
    echo '<h4 class="text-danger">Ha ocurrido un error, la oferta no ha podido identificarse correctamente.</h4>';
}

$jobPositionDescription = $_SESSION["jobOffer_position"]->getDescription();

$companyName = $_SESSION["jobOffer_company"]->getName();
$companyDescription = $_SESSION["jobOffer_company"]->getDescription();

unset($_SESSION["jobOffer_applied_student"]);
unset($_SESSION["jobOffer_position"]);
unset($_SESSION["jobOffer_company"]);

$back = FRONT_ROOT . 'JobOffer/ShowJobOffersAdminCatalogueView';
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
                                    <strong>Datos Adicionales y Estudiantes Aplicados</strong>
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
                                <hr>
                                <?php if ($jobOfferByStudentList) {
                                    echo '<label>Estudiante(s) con el puesto aplicado</label>';
                                    echo '<hr>';
                                    foreach ($jobOfferByStudentList as $jobOfferByStudent) { ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5><?= $jobOfferByStudent->getFirstName() . " " . $jobOfferByStudent->getLastName() . " / " . $jobOfferByStudent->getDni() ?></h5>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php } 
                                } else {
                                    echo '<h6>Aún no hay estudiantes aplicados a esta oferta laboral.</h6>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row mt-3">
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>

    </section>
</main>
