<?php
require_once('nav.php');

if (isset($_SESSION["applyState"]) && $_SESSION["applyState"] == 0) {
    $applyState = "<h4 class='text-danger mb-2'>Se ha producido un error y no fue posible postularte</h4>";
    unset($_SESSION["applyState"]);
}
else if (isset($_SESSION["applyState"]) && $_SESSION["applyState"] == 1) {
    $applyState = "<h3 class='text-success mb-2'>¡Felicitaciones! Tu postulación se ha registrado satisfactoriamente.</h3>";
    unset($_SESSION["applyState"]);
}
else {
    /***/
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <?= isset($applyState) ? $applyState : "" ?>
            <div class="row mt-2">
                <div class="col-md-12">
                    <h2 class="mb-4">Bienvenido/a <?= $_SESSION["activeStudent"]->getFirstName() . " " . $_SESSION["activeStudent"]->getLastName(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Mis datos</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver mis datos</h5>
                            <p class="card-text">Ver ficha de datos personales detallados.</p>
                            <a href="<?php echo FRONT_ROOT.'Student/ShowPersonalDataView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Modificar mis datos</h5>
                            <p class="card-text">Modifica tus datos personales a tu agrado.</p>
                            <a href="<?php echo FRONT_ROOT.'Student/ShowModifyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="mb-4">Acciones de Ofertas Laborales</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Ofertas Laborales</h5>
                            <p class="card-text">Mira las ofertas laborales y postulate ya!</p>
                            <a href="<?php echo FRONT_ROOT.'JobOffer/ShowJobOffersCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Historial de Ofertas Laborales</h5>
                            <p class="card-text">Mira el historial de las ofertas laborales actuales o que aplicaste en el pasado.</p>
                            <a href="<?php echo FRONT_ROOT.'JobOffer/ShowJobOffersStudentRecordView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="mb-4">Acciones de Empresas</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Empresas</h5>
                            <p class="card-text">Mirá la lista de empresas disponibles cercanas.</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowCompaniesCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>