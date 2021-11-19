<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <form action="<?= FRONT_ROOT ?>JobOffer/DeclineJobOffer" method="get">
                <input type="hidden" name="postulationdate" value="<?= $_SESSION["actualJobOfferDate"] ?>">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-4">Escriba el mail que notificará al alumno el por qué de su declinación.</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" name="mailcontent" rows="4" cols="100"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" style="margin-left: 3px;" title="Pobre alumno :(">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>