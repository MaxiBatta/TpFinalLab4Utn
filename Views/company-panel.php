<?php
require_once('nav.php');



if (isset($_SESSION["dbState"]) && $_SESSION["dbState"] == 1) {
    $dbState = '<h5 class="text-success">La API ha sido actualizada exitosamente.</h5>';
    unset($_SESSION["dbState"]);
}
else if (isset($_SESSION["dbState"]) && $_SESSION["dbState"] == 0) {
    $dbState = '<h5 class="text-danger">ERROR: '.$_SESSION["dbFailMessage"].'</h5>';
    unset($_SESSION["dbState"]);
    unset($_SESSION["dbFailMessage"]);
}
else {
    /***/
}



if (isset($_SESSION["registerState"]) && $_SESSION["registerState"] == 0) {
    $registerState = '<h5 class="text-danger">Ocurrió un error al registrar el usuario.</h5>';
    unset($_SESSION["registerState"]);
}
else if (isset($_SESSION["registerState"]) && $_SESSION["registerState"] == 1) {
    $registerState = '<h5 class="text-success">El usuario ha sido registrado exitosamente.</h5>';
    unset($_SESSION["registerState"]);
}
else { /***/ }

?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?= isset($errorExistingMail) ? $errorExistingMail : "" ?>
                    <?= isset($registerState) ? $registerState : "" ?>
                    <?= isset($dbState) ? $dbState : "" ?>
                    <?= isset($modifyState) ? $dbState : "" ?>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">Bienvenido <?= $_SESSION["activeCompany"]->getEmail() ?></h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Menu de Acciones</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Crear una Oferta laboral</h5>
                            <p class="card-text">Da de alta una nueva oferta de trabajo.</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowAddJobOfferView'?>" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mis oferta laborales</h5>
                            <p class="card-text">Muestra tus ofertas laborales.</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowJobOffersCatalogueView'?>" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                </div>
            </div>

    </section>
</main>