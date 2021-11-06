<?php
require_once('nav.php');

use DAO\Student as Student;
use DAO\StudentDAO as StudentDAO;

$studentDAO = new StudentDAO();
$studentList = $studentDAO->GetAllMySql();

$studentDAO = new studentDAO();
$studentList = $studentDAO->GetAllMySql();

$removeSearch = false;

if (isset($_SESSION["found_students"])) {
    $studentList = $_SESSION["found_students"];
    unset($_SESSION["found_students"]);

    $removeSearch = '<a href="' . FRONT_ROOT . 'Administrator/ShowStudentListBmView" class="btn btn-outline-danger text-strong" style="color: #ff0000">Restaurar</a>';
}

if (!$studentList) {
    $nullStudents = '<h4 class="text-danger">No hay alumnos con ese dni.</h4>';
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
                    <form action="<?= FRONT_ROOT ?>Student/ShowFilteredStudentListView" method="get">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <input type="text" class="flex-grow-1 form-control" name="dni" placeholder="Busca por dni...">
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
                echo "No hay ninguna oferta laboral disponible";
            } else {
                foreach ($studentList as $key => $student) {
                    ?>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h5><?= "Dni: " . $student->getDni() . " / " . $student->getFirstName() . " " . $student->getLastName() ?></h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="<?= FRONT_ROOT ?>Administrator/ShowAdminModifyView" method="get">
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