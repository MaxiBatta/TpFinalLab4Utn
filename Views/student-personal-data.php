<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container bg-light-alpha p-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4"><?= $_SESSION["activeStudent"]->getFirstName() . " " . $_SESSION["activeStudent"]->getLastName(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Nombre</label>
                    <h5><?= $_SESSION["activeStudent"]->getFirstName() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Apellido</label>
                    <h5><?= $_SESSION["activeStudent"]->getLastName() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>DNI</label>
                    <h5><?= $_SESSION["activeStudent"]->getDni() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Fecha de Nacimiento</label>
                    <h5><?= date('Y-m-d H:i:s', strtotime($_SESSION["activeStudent"]->getBirthDate())) ?></h5>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <label>Género</label>
                    <h5><?= $_SESSION["activeStudent"]->getGender() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Número de Teléfono</label>
                    <h5><?= $_SESSION["activeStudent"]->getPhoneNumber() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Correo</label>
                    <h5><?= $_SESSION["activeStudent"]->getEmail() ?></h5>
                </div>
            </div>
            <hr>
            <span style="font-size: 14px;">Datos Adicionales</span>
            <div class="row mt-4">
                <div class="col-md-3">
                    <label>Número de expediente</label>
                    <h5><?= $_SESSION["activeStudent"]->getFileNumber() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Id del estudiante</label>
                    <h5><?= $_SESSION["activeStudent"]->getStudentId() ?></h5>
                </div>
                <div class="col-md-3">
                    <label>Id de la carrera</label>
                    <h5><?= $_SESSION["activeStudent"]->getCareerId() ?></h5>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-right">
                   <a href="<?php echo FRONT_ROOT.'Student/ShowPanelView'?>" class="btn btn-primary">Volver</a> 
                </div>
            </div>
        </div>
        

    </section>
</main>