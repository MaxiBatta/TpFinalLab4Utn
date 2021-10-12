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
                            <th>Nombre</th>
                            <th>Año de fundación</th>
                            <th>Ciudad</th>
                            <th>Descripción</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Número de teléfono</th>
                            </thead>
                            <tbody>
                                <?php
                                $companyDAO = new CompanyDAO();
                                $companiesList = $companyDAO->GetAll();

                                if (!$companiesList) {
                                    echo "No hay ninguna compañía cargada o disponible";
                                }


                                foreach ($companiesList as $key => $value) { ?> 
                                    <tr>
                                        <td><?php echo $value->getName() ?></td>
                                        <td><?php echo $value->getYearFoundation() ?></td>
                                        <td><?php echo $value->getCity() ?></td>
                                        <td><?php echo $value->getDescription() ?></td>
                                        <td><?php echo $value->getlogo() ?></td>
                                        <td><?php echo $value->getEmail() ?></td>
                                        <td><?php echo $value->getPhoneNumber() ?></td>
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