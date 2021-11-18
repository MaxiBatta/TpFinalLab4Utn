<?php
require_once('nav.php');

$removeSearch = false;

if (isset($_SESSION["found_jobOffers"])) {
    if ($_SESSION["found_jobOffers"] == 0) {
        $nullJobOffers = '<h4 class="text-danger">No hay ofertas laborales disponibles.</h4>';
    }
    
    unset($_SESSION["found_jobOffers"]);
    
    $removeSearch = '<a href="'. FRONT_ROOT.'JobOffer/ShowJobOffersAdminCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
}

$back = FRONT_ROOT . 'Administraton/ShowPanelView';
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            
            <?= isset($nullJobOffers) ? $nullJobOffers : "" ?>
            
            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Listado ofertas de trabajo</p>
                </div>
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="<?= FRONT_ROOT ?>JobPosition/ShowFilteredJobPositionListView" method="get">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" class="flex-grow-1 form-control" name="description" placeholder="Busca por posición de trabajo..." value="<?= isset($_REQUEST["description"]) ? $_REQUEST["description"] : "" ?>">
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
                $count = 0;
                foreach ($jobOfferList as $key => $jobOffer) {
                    
                    foreach ($jobPositionList as $key => $jobPosition) {
                        if ($jobPosition->getJobPositionId() == $jobOffer->getJobPositionId()) {
                            $jobPositionDescription = $jobPosition->getDescription();
                        }
                    }

                    foreach ($companyList as $key => $company) {
                        if ($company->getCompanyId() == $jobOffer->getCompanyId()) {
                            $companyName = $company->getName();
                            $companyDescription = $company->getDescription();
                            $count++;
                        }
                    }
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4><?= $jobPositionDescription ?></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b><?= $companyName ?></b> - <?= $companyDescription ?></p>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 3px;">
                        <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferAdminDetailView" method="get">
                            <input type="hidden" name="jobOffer-id" value="<?= $jobOffer->getJobOfferId() ?>">
                            <div class="d-flex align-item-center">
                                <button type="submit" class="btn btn-primary">Ver detalle</button>
                            </div>
                        </form>
                    </div>
                    <div class="row" style="margin-left: 3px;">
                        <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferModifyView" method="get">
                            <input type="hidden" name="jobOffer-id" value="<?= $jobOffer->getJobOfferId() ?>">
                            <button type="submit" class="btn btn-danger mt-2">Modificar</button>
                        </form>
                    </div>
                    <?php
                    }
                echo "<p class='mt-5'>". ($count > 0 ? "Se han encontrado ".$count." oferta(s) laboral(es)." : "No hay ninguna oferta laboral disponible para tu carrera.") . "</p>";
            }
            ?>
        </div>
    </section>
</main>
