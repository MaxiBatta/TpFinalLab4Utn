<?php
require_once('nav.php');

use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$actual_company = $companyDAO->returnCompanyById($_SESSION["actual_company"]);

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