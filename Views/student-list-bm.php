<?php
require_once('nav.php');

$removeSearch = false;

if (isset($_SESSION["found_students"])) {
    if ($_SESSION["found_students"] == 0) {
        $nullStudents = '<h4 class="text-danger">No se han encontrado alumnos.</h4>';
    }
    
    unset($_SESSION["found_students"]);
    
    $removeSearch = '<a href="'. FRONT_ROOT.'Student/ShowStudentListBmView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
}
?>
<main class="py-5">
    <section id="listado" class="mb-5 bg-light-alpha p-5">
        <div class="container">

            <div class="row">
                <div class="col-md-10">
                    <p class="mb-5" style="font-size: 28px;">Lista de estudiantes registrados</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="<?= FRONT_ROOT ?>Student/ShowFilteredstudentListView" method="get">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" class="flex-grow-1 form-control" name="dni" placeholder="Buscar por dni..." value="<?= isset($_REQUEST["dni"]) ? $_REQUEST["dni"] : "" ?>">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Buscar</button>
                            </div>
                            <div class="col-md-2 text-right">
                                <?= $removeSearch ? $removeSearch : "" ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                </div>
            </div>

            <?php
            if (!$studentList) {
                echo "No se han encontrado alumnos con el dni proporcionado.";
            } else {
                foreach ($studentList as $key => $student) {
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5 class="<?= !$student->getActive() ? 'text-danger' : '' ?>"><?= "Dni: " . $student->getDni() . " / " . $student->getFirstName() . " " . $student->getLastName() . (!$student->getActive() ? ' (inactivo)' : '')?></h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="<?= FRONT_ROOT ?>Administrator/ShowAdminStudentModifyView" method="get">
                                <input type="hidden" name="student-id" value="<?= $student->getStudentId() ?>">
                                <button type="submit" class="btn btn-danger">Modificar</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <?php
                }
            }
            ?>
        </div>
    </section>
</main>