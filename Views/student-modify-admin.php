<?php
require_once('nav.php');

use DAO\CareerDAO as CareerDAO;
use DAO\StudentDAO as StudentDAO;

$studentDAO = new StudentDAO();
$toModifyStudent = $studentDAO->GetStudentById($_SESSION["toModifyStudent"]);

unset($_SESSION["toModifyStudent"]);
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h3 class="mb-4">Modificando a <?= $toModifyStudent->getFirstName() . " " . $toModifyStudent->getLastName() . " / " . $toModifyStudent->getDni() ?></h3>
            <form action="<?php echo FRONT_ROOT ?>Student/UpdateStudent" method="post" class="bg-light-alpha p-5">
                <div class="row mt-3">
                    <input type="hidden" name="studentId" value="<?= $toModifyStudent->getStudentId() ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="careerId">Carrera</label>
                            <select id="careerId" name="careerId" class="form-control">
                                <?php
                                    $careerDAO = new CareerDAO();
                                    $careersList = $careerDAO->GetAllMySql(); 
                                    foreach ($careersList as $key => $value) {
                                        if ($toModifyStudent->getCareerId() == $value->getCareerId()) {
                                            echo '<option value="'. $value->getCareerId() . '" selected="selected">' . $value->getDescription() . '</option>';
                                        }
                                        else {
                                            echo '<option value="'. $value->getCareerId() . '">' . $value->getDescription() . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="firstName">Nombre</label>
                            <input type="text" name="firstName" id= "firstName" class="form-control" value="<?= $toModifyStudent->getFirstName() ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lastName">Apellido</label>
                            <input type="text" name="lastName" id= "lastName" class="form-control" value="<?= $toModifyStudent->getLastName() ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" id= "dni" value="<?= $toModifyStudent->getDni() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="fileNumber">Expediente</label>
                            <input type="text" name="fileNumber" id= "fileNumber" value="<?= $toModifyStudent->getFileNumber() ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="gender">Género</label>
                            <input type="text" name="gender" id= "gender" value="<?= $toModifyStudent->getGender() ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="birthDate">Fecha de nacimiento</label>
                            <input type="datetime-local" name="birthDate" id="birthDate" value="<?= $toModifyStudent->getBirthDate() ?>" class="form-control" min="1920-01-01" step="1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id= "email" value="<?= $toModifyStudent->getEmail() ?>" class="form-control">
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Número de teléfono</label>
                            <input type="text" name="phoneNumber" id= "phoneNumber" value="<?= $toModifyStudent->getPhoneNumber() ?>" class="form-control">
                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="active">Estado</label>
                            <select name="active" id= "active" class="form-control">
                                <option value="1" <?= $toModifyStudent->getActive() == 1 ? "selected='selected'" : "" ?>>Activo</option>
                                <option value="0" <?= $toModifyStudent->getActive() == 0 ? "selected='selected'" : "" ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-danger ml-auto d-block">Modificar</button> 
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowStudentListBmView' ?>" class="btn btn-primary ml-2">Volver</a> 
                </div>
            </form>
        </div>
    </section>
    <?php
    if (isset($message))
        echo $message;
    ?>

</main>