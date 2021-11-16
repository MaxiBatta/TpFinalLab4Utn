<?php
require_once('nav.php');

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregando Ofertas laborales</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dateTime">Fecha de comienzo</label>
                            <input type="date" name="dateTime" id = "dateTime" value="" class="form-control" min="<?php  echo $today;?>" step="1" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="limitDate">Fecha Limite</label>
                            <input type="date" name="limitDate" id = "limitDate" value="" class="form-control" min="<?php echo date("Y-m-d",strtotime($tomorrow."+ 1 days"));?>" step="1" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select id="state" name="state" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label for="companyId">Empresa</label><br>
                            <select id="companyId" name="companyId" class="form-control" required>
                                <?php
                                foreach ($companyList as $key => $value) {
                                    echo "<option value=" . $value->getCompanyId() . ">" . $value->getName() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 ml-10">
                        <div class="form-group">
                            <label for="jobPositionId">Posicion de trabajo</label>
                            <select id="jobPositionId" name="jobPositionId" class="form-control" required>
                                <?php
                                foreach ($jobPositionList as $key => $value) {
                                    echo "<option value=" . $value->getJobPositionId() . ">" . $value->getDescription() . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
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