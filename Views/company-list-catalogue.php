<?php
require_once('nav.php');

use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$companiesList = $companyDAO->GetAll();

if (!$companiesList) {
    $nullCompanies = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
}
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <h2 class="mb-5">Empresas disponibles</h2>
            <?php
            $companyDAO = new CompanyDAO();
            $companiesList = $companyDAO->GetAll();
            $count = 1;

            if (!$companiesList) {
                echo "No hay ninguna compañía cargada o disponible";
            } else {
                foreach ($companiesList as $key => $value) {
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <img class="" src="<?= '../' . VIEWS_PATH . 'img/bg.png' ?>" width="183" height="180">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <h4><?= $value->getName() ?></h4>
                            </div>
                            <div class="row">
                                <p><?= $value->getDescription() ?></p>
                            </div>
                            <div class="row">
                                <p>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?= $count ?>" aria-expanded="false" aria-controls="collapse<?= $count ?>">
                                        Ver detalle
                                    </button>
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="padding-left: 0px !important;">
                                    <div class="collapse" id="collapse<?= $count ?>">
                                        <div class="card card-body">
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label>Ciudad</label>
                                                    <h5><?= $value->getCity() ?></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Año de fundación</label>
                                                    <h5><?= $value->getYearFoundation() ?></h5>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label>Número de teléfono</label>
                                                    <h5><a href="tel:"><?= $value->getPhoneNumber() ?></a></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Correo</label>
                                                    <h5><a href="mailto:"><?= $value->getEmail() ?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
            }
            ?>
        </div>

    </section>
</main>

<script>
    $(".detalle-empresa").click(
            function () {
                $.post(
                        $(this).data("url"),
                        {
                            "data_id": $(this).data("id")
                        },
                        function (response) {
                            alert("hola");
                        }
                );
            }
    );
</script>