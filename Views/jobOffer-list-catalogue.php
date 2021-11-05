<?php
require_once('nav.php');

use Controllers\JobOffer as JobOffer;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDao as CompanyDao;

$jobOfferDAO = new JobOfferDAO();
$jobOfferList = $jobOfferDAO->GetAllMySql();
$removeSearch = false;

if (isset($_SESSION["found_jobOffers"])) {
    $jobOfferList = $_SESSION["found_jobOffers"];
    unset($_SESSION["found_jobOffers"]);

    $removeSearch = '<a href="' . FRONT_ROOT . 'Student/ShowOffersCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';

    if (isset($_SESSION["adminLogged"])) {
        $removeSearch = '<a href="' . FRONT_ROOT . 'Administrator/ShowOffersCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
    }
}

if (!$jobOfferList) {
    $nullJObOffers = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
}

$back = VIEWS_PATH . "index.php";

if (isset($_SESSION["adminLogged"])) {
    $back = FRONT_ROOT . 'Administrator/ShowPanelView';
} else {
    $back = FRONT_ROOT . 'Student/ShowPanelView';
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
                    <form action="<?= FRONT_ROOT ?>JobPosition/ShowFilteredJobPositionListView" method="get">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" class="flex-grow-1 form-control" name="description" placeholder="Busca por posición de trabajo...">
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
                foreach ($jobOfferList as $key => $jobOffer) {
                    $jobPositionDAO = new JobPositionDAO();
                    $jobPositionList = $jobPositionDAO->GetAllMySql();

                    $companyDAO = new CompanyDAO();
                    $companyList = $companyDAO->GetAllMySql();

                    foreach ($jobPositionList as $key => $jobPosition) {
                        if ($jobPosition->getJobPositionId() == $jobOffer->getJobPositionId()) {
                            $jobPositionDescription = $jobPosition->getDescription();
                        }
                    }
                    foreach ($companyList as $key => $company) {
                        if ($company->getCompanyId() == $jobOffer->getCompanyId()) {
                            $companyName = $company->getName();
                            $companyDescription = $company->getDescription();
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
                        <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferDetailView" method="get">
                            <input type="hidden" name="jobOffer-id" value="<?= $jobOffer->getJobOfferId() ?>">
                            <div class="d-flex align-item-center">
                                <button type="submit" class="btn btn-primary">Ver detalle</button>
                            </div>
                        </form>
                    </div>
                    <?php if (isset($_SESSION["adminLogged"])) { ?>  
                        <div class="row" style="margin-left: 3px;">
                            <form action="<?= FRONT_ROOT ?>JobOffer/ShowOfferModifyView" method="get">
                                <input type="hidden" name="jobOffer-id" value="<?= $jobOffer->getJobOfferId() ?>">
                                <button type="submit" class="btn btn-danger mt-2">Modificar</button>
                            </form>
                        </div>
                    <?php
                    }
                }
            }
            ?>
        </div>
    </section>
</main>