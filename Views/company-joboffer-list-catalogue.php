<?php
require_once('nav.php');


?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">
            
            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Ofertas de trabajo pertenecientes a la empresa</p>
                </div>
                <div class="col-md-2">
                <a href="<?php echo FRONT_ROOT . 'Company/ShowAddJobOfferView' ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>


            <?php
            if (!$jobOfferList) {
                echo "No hay ninguna oferta laboral disponible";
            } 
                    ?>
                    
 <main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Ofertas laborales</h2>

            <div class="row">
                <div class="col-md-12">
                    <h2><?= $actual_company->getName() ?></h2>
                </div>
            </div>
            
            <table class="table bg-light">
                <thead class="bg-dark text-white">
                
                <th>Id Oferta Laboral</th>
                <th>Fecha</th>
                <th>Fecha limite</th>
                
                </thead>
                <tbody>
                  
                       
                    <?php

                        foreach ($jobOfferList as $jobOffer) {
                        
                        ?>
                        <tr>
                            <th><?= $jobOffer->getJobOfferId() ?></th>
                            <th><?= $jobOffer->getDateTime() ?></th>
                            <th><?= $jobOffer->getLimitDate() ?></th>
                        
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </section>
</main>


