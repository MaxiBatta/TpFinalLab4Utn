<?php
require_once('nav.php');

use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$companiesList = $companyDAO->GetAll(false);
$removeSearch = false;

if (isset($_SESSION["found_companies"])) {
    $companiesList = $_SESSION["found_companies"];
    unset($_SESSION["found_companies"]);
    $removeSearch = '<a href="'. FRONT_ROOT.'Student/ShowCompaniesCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
}

if (!$companiesList) {
    $nullCompanies = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
}
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            
           
            
            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Empresas disponibles</p>
                </div>
                <div class="col-md-2">
                    <a href="<?php echo FRONT_ROOT.'Student/ShowPanelView'?>" class="btn btn-primary">Volver</a>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="<?= FRONT_ROOT ?>Company/ShowFilteredCompanyListView" method="post">
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
            
            if (!$companiesList) {
                echo "No hay ninguna compañía cargada o disponible";
            } else {
                foreach ($companiesList as $key => $value) {
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <img class="" src="<?= '../' . VIEWS_PATH . 'img/' . $value->getLogo() ?>" width="183" height="180">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <h4><?= $value->getName() ?></h4>
                            </div>
                            <div class="row">
                                <p><?= $value->getDescription() ?></p>
                            </div>
                            <div class="row">
                                <form action="<?= FRONT_ROOT ?>Company/ShowCompanyDetailView" method="post">
                                    <input type="hidden" name="company-id" value="<?= $value->getCompanyId() ?>">
                                    <div class="d-flex align-item-center">
                                        <button type="submit" class="btn btn-primary">Ver detalle</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <form action="<?= FRONT_ROOT ?>Company/ShowCompanyModifyView" method="post">
                                    <input type="hidden" name="company-id" value="<?= $value->getCompanyId() ?>">
                                    <div class="d-flex align-item-center">
                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </section>
</main>