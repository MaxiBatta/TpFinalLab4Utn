<?php
require_once('nav.php');

use DAO\CompanyDao as CompanyDAO;

$companyDAO = new CompanyDAO();
$toModifyCompany = $companyDAO->returnCompanyByIdMySql($_SESSION["toModifyCompany"]);

unset($_SESSION["toModifyCompany"]);
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificando Empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/ModifyCompany" method="post" class="bg-light-alpha p-5">
                <input type="hidden" name="companyId" value="<?= $toModifyCompany->getCompanyId() ?>">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?= $toModifyCompany->getName() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="yearFoundation">Year of Foundation</label>
                            <input type="datetime-local" id="yearFoundation" name="yearFoundation" value="<?= $toModifyCompany->getYearFoundation() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" value="<?= $toModifyCompany->getCity() ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" value="<?= $toModifyCompany->getDescription() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" value="<?= $toModifyCompany->getLogo() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= $toModifyCompany->getEmail() ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Phone number</label>
                            <input type="text" id="phoneNumber" name="phoneNumber" value="<?= $toModifyCompany->getPhoneNumber() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="active">Estado</label>
                            <select id="active" name="active" class="form-control" >
                                <option value="1" <?= $toModifyCompany->getActive() == 1 ? "selected='selected'" : "" ?>>Activo</option>
                                <option value="0" <?= $toModifyCompany->getActive() == 0 ? "selected='selected'" : "" ?>>Inactivo</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                    <button type="submit" class="btn btn-danger ml-auto d-block">Modificar</button>
                </div>
            </form>
        </div>
    </section>
    <?php
    if (isset($message))
        echo $message;
    ?>
</main>