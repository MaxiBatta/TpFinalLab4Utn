<?php
require_once('nav.php');

use DAO\CompanyDao as CompanyDAO;
use DAO\JobPositionDao as JobPositionDAO;
use DAO\StudentDao as StudentDAO;
use DAO\JobOfferDao as JobOfferDAO;

$jobOfferDAO = new JobOfferDAO();
$toModifyJobOffer = $jobOfferDAO->GetjobOfferById($_SESSION["toModifyJobOffer"]);

unset($_SESSION["toModifyJobOffer"]);

$studentDAO = new StudentDAO();
$studentsList = $studentDAO->GetAllMySql();
$jobPositionDAO = new JobPositionDAO();
$jobPositionLists = $jobPositionDAO->GetAllMySql();
$companyDAO = new CompanyDAO();
$companiesList = $companyDAO->GetAllMySql();
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modificando Oferta laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ModifyJobOffer" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <input type="hidden" name="jobOfferId" value="<?= $toModifyJobOffer->getJobOfferId() ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dateTime">Fecha de comienzo</label>
                            <input type="datetime-local" id="dateTime" name="dateTime" value="<?= $toModifyJobOffer->getDateTime() ?>" class="form-control" min="1950-01-01" step="1" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="limitDate">Fecha Limite</label>
                            <input type="datetime-local" id="limitDate" name="limitDate" value="<?= $toModifyJobOffer->getLimitDate(); ?>" class="form-control" min="tomorrow" step="1" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select id="state" name="state" class="form-control" >
                                <option value="1" <?= $toModifyJobOffer->getState() == 1 ? "selected='selected'" : "" ?>>Activo</option>
                                <option value="0" <?= $toModifyJobOffer->getState() == 0 ? "selected='selected'" : "" ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>                         
                </div>
                <div class="row">
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label for="companyId">Empresa</label><br>
                            <select id="companyId" name="companyId" class="form-control" >
                                <?php
                                foreach ($companiesList as $key => $value) {
                                    if ($toModifyJobOffer->getCompanyId() == $value->getCompanyId()) {
                                        echo '<option value="' . $value->getCompanyId() . '" selected="selected">' . $value->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $value->getCompanyId() . '">' . $value->getName() . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 ml-10">
                        <div class="form-group">
                            <label for="jobPositionId">Posicion de trabajo</label>
                            <select name="jobPositionId" id="jobPositionId" class="form-control" >
                                <?php
                                foreach ($jobPositionLists as $key => $value) {
                                    if ($toModifyJobOffer->getJobPositionId() == $value->getJobPositionId()) {
                                        echo '<option value="' . $value->getJobPositionId() . '" selected="selected">' . $value->getDescription() . '</option>';
                                    } else {
                                        echo '<option value="' . $value->getJobPositionId() . '">' . $value->getDescription() . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="studentId">Student</label>
                            <div class="input-group">
                                <select id="studentId" class="form-control" name="studentId" title="pobre chabón mira que le vas a cambiar la oferta">
                                    <option value="0">Sin postulación</option>
                                    <?php
                                    foreach ($studentsList as $key => $value) {
                                        if ($toModifyJobOffer->getStudentId() == $value->getStudentId()) {
                                            echo '<option value="' . $value->getStudentId() . '" selected="selected">' . $value->getFirstName() . " " . $value->getLastName() . '</option>';
                                        } else {
                                            echo '<option value="' . $value->getStudentId() . '">' . $value->getFirstName() . " " . $value->getLastName() . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <a id="change-student-offer" class="btn btn-danger ml-auto d-block text-white" title="Cambiar injustamente el alumno que se postuló">Cambiar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                    <button type="submit" class="btn btn-danger ml-auto d-block">Modificar</button> 
                </div>
            </form>
        </div>
    </section>
<?php
if (isset($message))
    echo $message;
?>

</main>

<script>
    $(document).ready(function() {
        
        $("#change-student-offer").click(
            function() {
                if ($(this).hasClass("btn-danger")) {
                    $("#studentId").removeAttr("disabled");
                    $(this).removeClass("btn-danger");
                    $(this).addClass("btn-dark");
                    $(this).attr("title", ":(");
                }
            }
        );
        
    });
</script>