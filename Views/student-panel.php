<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Bienvenido <?= $_SESSION["activeStudent"]->getFirstName() . " " . $_SESSION["activeStudent"]->getLastName(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Menú de Acciones</h5>
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
                            <h5 class="card-title">Buscar Empresas</h5>
                            <p class="card-text">Mirá la lista de empresas disponibles y postulate ya!</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowCompaniesCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Ofertas Laborales</h5>
                            <p class="card-text">Mirá las ofertas disponibles y postulate ya!</p>
                            <a href="<?php echo FRONT_ROOT.'JobOffer/ShowJobOffersCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Modificar mis datos</h5>
                            <p class="card-text">Modifica tus datos personales.</p>
                            <a href="<?php echo FRONT_ROOT.'Student/ShowModifyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</main>