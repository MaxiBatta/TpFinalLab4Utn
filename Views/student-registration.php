<?php
require_once('nav.php');


?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Registrando a un alumno</h2>
            <form action="<?php echo FRONT_ROOT ?>Register/RegisterStudent" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <!--<input type="number" name="studentId" id= "studentId" value="" class="form-control">-->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="careerId">Carrera</label>
                            <select id="careerId" name="careerId" class="form-control" required>
                                <option value="0">Seleccionar...</option>
                                <?php
                                    foreach ($careerLists as $key => $value) {
                                        if($value->getActive()){
                                        echo "<option value=" . $value->getCareerId() . ">" . $value->getDescription() . "</option>";
                                    }
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
                            <input type="text" name="fileNumber" id= "fileNumber" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"> 
                            <label for="gender">Género</label>
                            <input type="text" name="gender" id= "gender" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="birthDate">Fecha de nacimiento</label>
                            <input type="datetime-local" name="birthDate" id = "birthDate" value="" class="form-control" min="1920-01-01" step="1" required>
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
                    <input type="number" name="active" id= "active" value="1" class="form-control" style="display: none;">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button> 
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary ml-2">Volver</a> 
                </div>
            </form>
        </div>
    </section>
    <?php
    if (isset($message))
        echo $message;
    ?>

</main>