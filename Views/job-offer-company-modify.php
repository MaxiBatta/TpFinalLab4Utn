<?php

require_once('nav.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificando Oferta laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ModifyJobOffer" method="post" class="bg-light-alpha p-5">
                <p class="bg-dark-alpha">Si querés hacer que la oferta no aparezca cambiá el estado a Inactivo o viceversa.</p>
                <div class="row">
                    <input type="hidden" name="jobOfferId" value="<?= $toModifyJobOffer->getJobOfferId() ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dateTime">Fecha de comienzo</label>
                            <input type="datetime-local" id="dateTime" name="dateTime" value="<?= $toModifyJobOffer->getDateTime() ?>" class="form-control" min="1950-01-01" step="1" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="limitDate">Fecha Limite</label>
                            <input type="datetime-local" id="limitDate" name="limitDate" value="<?= $toModifyJobOffer->getLimitDate(); ?>" class="form-control" min="tomorrow" step="1" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select id="state" name="state" class="form-control" >
                                <option value="1" <?= $toModifyJobOffer->getState() == 1 ? "selected='selected'" : "" ?>>Activo</option>
                                <option value="0" <?= $toModifyJobOffer->getState() == 0 ? "selected='selected'" : "" ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>                         
                </div>
                <div class="row">
                    <input type="hidden" name="companyId" value="<?= $_SESSION["activeCompany"]->getCompanyId() ?>">
                    <div class="col-lg-4 ml-10">
                        <div class="form-group">
                            <label for="jobPositionId">Posicion de trabajo</label>
                            <select name="jobPositionId" id="jobPositionId" class="form-control" >
                                <?php
                                foreach ($jobPositionList as $key => $value) {
                                    if ($toModifyJobOffer->getJobPositionId() == $value->getJobPositionId()) {
                                        echo '<option value="' . $value->getJobPositionId() . '" selected="selected">' . $value->getDescription() . '</option>';
                                    } else {
                                        echo '<option value="' . $value->getJobPositionId() . '">' . $value->getDescription() . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="studentId" value="0">
                <div class="d-flex justify-content-end mt-3">
                    <a href="<?php echo FRONT_ROOT . 'JobOffer/ShowJobOffersCatalogueCompanyView' ?>" class="btn btn-primary">Volver</a> 
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