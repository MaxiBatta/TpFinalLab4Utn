<?php
require_once('nav.php');

use DAO\Connection as Connection;

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

if (isset($_SESSION["existingMail"])) {
    $errorExistingMail = '<h5 class="text-danger mt-3">Ya existe un usuario con ese mail registrado.</h5>';
    unset($_SESSION["existingMail"]);
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-4">Bienvenido <?= $_SESSION["activeAdministrator"]->getEmail() ?></h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Acciones de Empresas</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Crear Empresa</h5>
                            <p class="card-text">Genera una nueva Empresa.</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowAddCompanyView'?>" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver Empresas </h5>
                            <p class="card-text">Ver y Modificar Empresas</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowCompaniesCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver Tabla Empresas </h5>
                            <p class="card-text">Listar empresas como tabla</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowListCompanyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Eliminar Empresas </h5>
                            <p class="card-text">Eliminar una empresa por ID</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowDeleteCompanyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reactivar una empresa </h5>
                            <p class="card-text">Da de alta a una empresa inactiva</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowActiveCompanyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>-->
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="mb-4">Acciones de Ofertas Laborales</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Crear una Oferta Laboral </h5>
                            <p class="card-text">Da de alta una nueva oferta laboral</p>
                            <a href="<?php echo FRONT_ROOT.'JobOffer/ShowAddJobOfferView'?>" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver Ofertas Laborales</h5>
                            <p class="card-text">Ver y Modificar ofertas laborales</p>
                            <a href="<?php echo FRONT_ROOT.'JobOffer/ShowJobOffersCatalogueView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Acciones de Estudiantes</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Registrar un estudiante</h5>
                            <p class="card-text">Da de alta un nuevo estudiante</p>
                            <a href="<?php echo FRONT_ROOT.'Register/ShowRegisterView'?>" class="btn btn-primary">Crear</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver estudiantes</h5>
                            <p class="card-text">Ver y Modificar estudiantes.</p>
                            <a href="<?php echo FRONT_ROOT.'Administrator/ShowStudentListBmView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="mb-4">Otros</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">API a DB</h5>
                            <p class="card-text">Escribe los datos de la API a la DB.</p>
                            <p class="card-text">Arrojará un error en el encabezado de la página en caso de keys duplicadas.</p>
                            <a href="<?php echo FRONT_ROOT . 'Data/getAllData' ?>" class="btn btn-danger">Actualizar</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>