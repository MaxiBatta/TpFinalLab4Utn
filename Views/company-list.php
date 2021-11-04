<?php
require_once('nav.php');


use Controllers\Company as Company;
use DAO\CompanyDao as CompanyDAO;




$companyDAO = new CompanyDAO();
$companiesList = $companyDAO->GetAllMySql();
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <div class="row">
                <div class="col-md-12">
                    <table>
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
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
            </div>
        </div>

    </section>
</main>