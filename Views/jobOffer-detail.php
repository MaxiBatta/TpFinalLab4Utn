<?php
require_once('nav.php');

use Controllers\JobOffer as JobOffer;
use DAO\JobOfferDao as JobOfferDAO;

$jobOfferDAO = new JobOfferDAO();
$actual_jobOffer = $jobOfferDAO->returnJobOfferById($_SESSION["actual_jobOffer"]);

if (!$actual_jobOffer) {
    echo '<h4 class="text-danger">Ha ocurrido un error, la oferta no ha podido identificarse correctamente.</h4>';
}

$back = FRONT_ROOT.'JobOffer/ShowOffersCatalogueView';
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row mt-3">
                        <div class="col-md-6">
                                <label>Id Oferta Laboral</label>
                                <h5><?= $actual_jobOffer->getJobOfferId() ?></h5>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha</label>
                                <h5><?= $actual_jobOffer->getDateTime() ?></h5>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha limite</label>
                                <h5><?= $actual_jobOffer->getLimitDate() ?></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Estado</label>
                                <h5><?= $actual_jobOffer->getState() ?></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
                <?php if(isset($_SESSION["studentLogged"])) { ?>
                <div class="col-md-10 text-right">
                    <button id='btn-postulate' class="btn btn-danger" data-toggle="modal" data-target="#proximaEntregaModal">¡Postulate!</button>
                </div>
                <?php } ?>
            </div>
        </div>

    </section>
</main>

<div class="modal fade" id="proximaEntregaModal" tabindex="-1" role="dialog" aria-labelledby="proximaEntregaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mas despacio velocista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta función estará disponible en la próxima entrega.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>