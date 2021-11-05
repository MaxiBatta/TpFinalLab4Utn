<?php
require_once('nav.php');

use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$actual_company = $companyDAO->returnCompanyByIdMySql($_SESSION["actual_company"]);

if (!$actual_company) {
    echo '<h4 class="text-danger">Ha ocurrido un error, la empresa no ha podido identificarse correctamente.</h4>';
}

$back = FRONT_ROOT.'Company/ShowCompaniesCatalogueView';
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2><?= $actual_company->getName() ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mt-3"><?= $actual_company->getDescription() ?></h5>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Ciudad</label>
                                <h5><?= $actual_company->getCity() ?></h5>
                            </div>
                            <div class="col-md-6">
                                <label>Año de fundación</label>
                                <h5><?= $actual_company->getYearFoundation() ?></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Número de teléfono</label>
                                <h5><a href="tel:"><?= $actual_company->getPhoneNumber() ?></a></h5>
                            </div>
                            <div class="col-md-6">
                                <label>Correo</label>
                                <h5><a href="mailto:"><?= $actual_company->getEmail() ?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <a href="<?= $back ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>

    </section>
</main>