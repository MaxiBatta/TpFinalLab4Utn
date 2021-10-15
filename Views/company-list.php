<?php
require_once('nav.php');

use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$companiesList = $companyDAO->GetAll(true ,false);

if (!$companiesList) {
    $nullCompanies = '<h4 class="text-danger">No hay empresas disponibles.</h4>';
}

?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <div class="row">
                <div class="col-md-12">
                <?php
                    if (isset($nullCompanies)) {
                        echo $nullCompanies;
                    }
                    else { ?>
                    <table style="width: 100%;">
                            <thead>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Año de fundación</th>
                            <th>Ciudad</th>
                            <th>Descripción</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Número de teléfono</th>
                            <th>Activo</th>
                            </thead>
                            <tbody>
                                <?php
                               
                                foreach ($companiesList as $key => $value) { ?> 
                                    <tr>
                                        <td><?= $value->getCompanyId() ?></td>
                                        <td><?= $value->getName() ?></td>
                                        <td><?= $value->getYearFoundation() ?></td>
                                        <td><?= $value->getCity() ?></td>
                                        <td><?= $value->getDescription() ?></td>
                                        <td><?= $value->getlogo() ?></td>
                                        <td><?= $value->getEmail() ?></td>
                                        <td><?= $value->getPhoneNumber() ?></td>
                                        <td><?=$value->getActive() ? "Activo" : "<strong class='text-danger'> Inactivo</strong>"?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>

    </section>
</main>