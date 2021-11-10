<?php
require_once('nav.php');



$removeSearch = false;


if (isset($_SESSION["validateError"])){
if($_SESSION["validateError"]==0){
    $validateError= '<h4 class="text-success">La empresa se ha agregada de forma exitosa</h4>';
}elseif ($_SESSION["validateError"]==1){
    $validateError= '<h4 class="text-danger">Se han ingresado valores no permitidos</h4>';
}elseif($_SESSION["validateError"]==2){
    $validateError= '<h4 class="text-danger">La empresa ya se encuentra registrada</h4>';
}else {
    /*...*/
}
}



if (isset($_SESSION["found_companies"])) {
    $companyList = $_SESSION["found_companies"];
    unset($_SESSION["found_companies"]);
    
    $removeSearch = '<a href="'. FRONT_ROOT.'Student/ShowCompaniesCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
    
    if (isset($_SESSION["adminLogged"])) {
        $back = FRONT_ROOT.'Administrator/ShowPanelView';
        $removeSearch = '<a href="'. FRONT_ROOT.'Administrator/ShowCompaniesCatalogueView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
    }
}

if (!$companyList) {
    $nullCompanies = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
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
                <div class="col-md-12">
                    <?= isset ($validateError) ? $validateError : ""  ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Empresas disponibles</p>
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
            
            if (!$companyList) {
                echo "No hay ninguna compañía cargada o disponible";
            } else {
                foreach ($companyList as $key => $company) {
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <img class="" src="<?= '../' . VIEWS_PATH . 'img/' . $company->getLogo() ?>" width="183" height="180">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <h4><?= $company->getName() ?></h4>
                            </div>
                            <div class="row">
                                <p><?= $company->getDescription() ?></p>
                            </div>
                            <div class="row">
                                <form action="<?= FRONT_ROOT ?>Company/ShowCompanyDetailView" method="get">
                                    <input type="hidden" name="company-id" value="<?= $company->getCompanyId() ?>">
                                    <div class="d-flex align-item-center">
                                        <button type="submit" class="btn btn-primary">Ver detalle</button>
                                    </div>
                                </form>
                            </div>
                            <?php if(isset($_SESSION["adminLogged"])) { ?>
                                <div class="row">
                                    <form action="<?= FRONT_ROOT ?>Company/ShowCompanyModifyView" method="get">
                                        <input type="hidden" name="company-id" value="<?= $company->getCompanyId() ?>">
                                        <button type="submit" class="btn btn-danger mt-2">Modificar</button>
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