<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregando Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="jobPosition">Posicion de trabajo</label>
                                   <input type="text" name="jobPosition" id= "jobPosition" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="dateCreation">Fecha de comienzo</label>
                                   <input type="date" name="dateCreation" id = "dateCreation" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="dateLimit">Fecha Limite</label>
                                   <input type="date" name="dateLimit" id = "dateLimit" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="description">Descripcion</label>
                                   <input type="text" name="description" id= "description" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="company">Compañia</label>
                                   <input type="text" name="company" id="company" value="" class="form-control" minlength="10" required>
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
          if (isset ($message))
          echo $message;
     ?>

</main>