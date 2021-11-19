<?php
require_once('nav.php');


?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            <h2 class="mb-4">Historial de ofertas laborales</h2>
            <?php
            if (!$jobOfferByStudentList) {
                echo "Aún no te has postulado a ninguna oferta laboral.";
            } else {
                echo '<hr>';
                
                $index = 0;
                $jobOfferPostulationDate = array();
                
                foreach ($jobOfferByStudentPostulationDates as $key => $jobOfferByStudentPostulationDate) {
                    $jobOfferPostulationDate[$index] = $jobOfferByStudentPostulationDate->getPostulationDate();
                    $index++;
                }
                
                $index = 0;
                
                foreach ($jobOfferByStudentList as $key => $jobOffer) {
                    foreach ($jobPositionList as $key => $jobPosition) {
                        if ($jobPosition->getJobPositionId() == $jobOffer->getJobPositionId()) {
                            $jobPositionDescription = $jobPosition->getDescription();
                        }
                    }

                    foreach ($companyList as $key => $company) {
                        if ($company->getCompanyId() == $jobOffer->getCompanyId()) {
                            $companyName = $company->getName();
                            $companyDescription = $company->getDescription();
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <p>Te postulaste el 
                            <?php 
                                echo $jobOfferPostulationDate[$index];
                                $index++;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4><?= $jobPositionDescription ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><b><?= $companyName ?></b> - <?= $companyDescription ?></p>
                    </div>
                </div>
                <div class="row" style="margin-left: 3px;">
                    <form action="<?= FRONT_ROOT ?>JobOffer/ShowJobOfferDetailView" method="get">
                        <input type="hidden" name="jobOffer-id" value="<?= $jobOffer->getJobOfferId() ?>">
                        <input type="hidden" name="from-record" value="1">
                        <div class="d-flex align-item-center">
                            <button type="submit" class="btn btn-primary">Ver detalle</button>
                        </div>
                    </form>
                </div>
                <hr>
                <?php 
                }
            }
            ?>
            <div class="d-flex justify-content-end mt-3">
                <a href="<?php echo FRONT_ROOT . 'Student/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
            </div>
        </div>
    </section>
</main>