<?php
require_once('nav.php');

use Controllers\JobOffer as JobOffer;
use DAO\JobOfferDao as JobOfferDAO;

$jobOfferDAO = new JobOfferDAO();
$jobOfferList = $jobOfferDAO->GetAllMySql();
$removeSearch = false;

if (isset($_SESSION["found_jobOffers"])) {
    $jobOfferList = $_SESSION["found_jobOffers"];
    unset($_SESSION["found_jobOffers"]);
    
    $removeSearch = '<a href="'. FRONT_ROOT.'Student/ShowOfferCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
    
    if (isset($_SESSION["adminLogged"])) {
        $back = FRONT_ROOT.'Administrator/ShowPanelView';
        $removeSearch = '<a href="'. FRONT_ROOT.'Administrator/ShowOfferCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
    }
}

if (!$jobOfferList) {
    $nullJObOffers = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
}

$back = VIEWS_PATH . "index.php";

if (isset($_SESSION["adminLogged"])) {
    $back = FRONT_ROOT.'Administrator/ShowPanelView';
}
else {
    $back = FRONT_ROOT.'Student/ShowPanelView';
}

?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            
            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Ofertas de trabajo disponibles</p>
                </div>
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="<?= FRONT_ROOT ?>Company/ShowFilteredCompanyListView" method="get">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" class="flex-grow-1 form-control" name="name" placeholder="Busca una empresa...">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Buscar</button>
                            </div>
                            <div class="col-md-2">
                                <?= $removeSearch ? $removeSearch : "" ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php
            
            if (!$jobOfferList) {
                echo "No hay ninguna oferta laboral disponible";
            } else {
                foreach ($jobOfferList as $key => $value) {
                    ?>
                    <div class="row mt-3">
                        
                        <div class="col-md-9">
                            <div class="row">
                                <h4><?= $value->getDateTime() ?></h4>
                            </div>
                            <div class="row">
                                <p><?= $value->getLimitDate() ?></p>
                            </div>
                            <div class="row">
                                <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferDetailView" method="get">
                                    <input type="hidden" name="jobOffer-id" value="<?= $value->getJobOfferId() ?>">
                                    <div class="d-flex align-item-center">
                                        <button type="submit" class="btn btn-primary">Ver detalle</button>
                                    </div>
                                </form>
                            </div>
                            <?php if(isset($_SESSION["adminLogged"])) { ?>  
                                <div class="row">
                                    <form action="<?= FRONT_ROOT ?>Company/ShowCompanyModifyView" method="get">
                                        <input type="hidden" name="company-id" value="<?= $value->getCompanyId() ?>">
                                        <button type="submit" class="btn btn-primary mt-2">Modificar</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </section>
</main>