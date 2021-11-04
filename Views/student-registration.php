<?php
require_once('nav.php');

use DAO\CompanyDao as CompanyDAO;
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registrándome como alumno</h2>
            <form action="<?php echo FRONT_ROOT ?>Register/RegisterStudent" method="post" class="bg-light-alpha p-5">
                <div class="row">   
                    <!--<input type="number" name="studentId" id= "studentId" value="" class="form-control">-->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="careerId">Carrera</label>
                            <select id="careerId" name="careerId" class="form-control" required>
                                <option value="0">Seleccionar...</option>
                                <?php
                                    $companyDAO = new CompanyDAO();
                                    $companiesList = $companyDAO->GetAllMySql(); 
                                    
                                    foreach ($companiesList as $key => $value) {
                                        echo "<option value=" . $value->getCompanyId() . ">" . $value->getName() . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="firstName">Nombre</label>
                            <input type="text" name="firstName" id= "firstName" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="lastName">Apellido</label>
                            <input type="text" name="lastName" id= "lastName" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" name="dni" id= "dni" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="fileNumber">Expediente</label>
                            <input type="text" name="fileNumber" id= "fileNumber" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="gender">Género</label>
                            <input type="text" name="gender" id= "gender" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="birthDate">Fecha de nacimiento</label>
                            <input type="date" name="birthDate" id = "birthDate" value="" class="form-control" min="1920-01-01" step="1" required>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id= "email" value="" class="form-control" required>
                       </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phoneNumber">Número de teléfono</label>
                            <input type="text" name="phoneNumber" id= "phoneNumber" value="" class="form-control" required>
                       </div>
                    </div>
                            <input type="number" name="active" id= "active" value="1" class="form-control" required>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button> 
                </div>
            </form>
        </div>
    </section>
    <?php
    if (isset($message))
        echo $message;
    ?>

</main>