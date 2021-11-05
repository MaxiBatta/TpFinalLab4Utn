<?php
require_once('nav.php');

use DAO\CareerDAO as CareerDAO;
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificando</h2>
            <form action="<?php echo FRONT_ROOT ?>Student/UpdateStudent" method="post" class="bg-light-alpha p-5">
                <p class="bg-dark-alpha"><b>¡Tranquilo!</b> Tené en cuenta que si dejás un campo sin modificar se guardará la información que tenías antes.</p>
                <div class="row mt-3">
                    <input type="hidden" name="studentId" value="<?= $_SESSION["activeStudent"]->getStudentId() ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="careerId">Carrera</label>
                            <select id="careerId" name="careerId" class="form-control" <?= !isset($_SESSION["adminLogged"]) ? "disabled='disabled'" : "" ?>>
                                <?php
                                    $careerDAO = new CareerDAO();
                                    $careersList = $careerDAO->GetAllMySql(); 
                                    foreach ($careersList as $key => $value) {
                                        if ($_SESSION["activeStudent"]->getCareerId() == $value->getCareerId()) {
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
                            <input type="text" name="firstName" id= "firstName" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lastName">Apellido</label>
                            <input type="text" name="lastName" id= "lastName" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" id= "dni" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="fileNumber">Expediente</label>
                            <input type="text" name="fileNumber" id= "fileNumber" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="gender">Género</label>
                            <input type="text" name="gender" id= "gender" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="birthDate">Fecha de nacimiento</label>
                            <input type="datetime-local" name="birthDate" id="birthDate" value="" class="form-control" min="1920-01-01" step="1">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id= "email" value="" class="form-control">
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Número de teléfono</label>
                            <input type="text" name="phoneNumber" id= "phoneNumber" value="" class="form-control">
                       </div>
                    </div>
                    <input type="number" name="active" id= "active" value="1" class="form-control" style="display: none;">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-danger ml-auto d-block">Modificar</button> 
                    <a href="<?php echo FRONT_ROOT . 'Student/ShowPanelView' ?>" class="btn btn-primary ml-2">Volver</a> 
                </div>
            </form>
        </div>
    </section>
    <?php
    if (isset($message))
        echo $message;
    ?>

</main>