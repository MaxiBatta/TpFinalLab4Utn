<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Bienvenido <?= $_SESSION["activeAdministrator"]->getEmail() ?></h2>
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
                            <h5 class="card-title">Eliminar Empresas </h5>
                            <p class="card-text">Eliminar una empresa por ID</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowDeleteCompanyView'?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ver Tabla Empresas </h5>
                            <p class="card-text">Listar empresas como tabla</p>
                            <a href="<?php echo FRONT_ROOT.'Company/ShowListCompanyView'?>" class="btn btn-primary">Ver</a>
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
            </div>
            
        </div>

    </section>
</main>