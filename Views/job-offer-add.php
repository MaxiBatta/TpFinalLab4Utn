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
                                   <input type="date" name="dateTime" id = "dateTime" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="limitDate">Fecha Limite</label>
                                   <input type="date" name="limitDate" id = "limitDate" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="state">Estado</label>
                                   <input type="boolean" name="state" id= "state" value="" class="form-control" required>
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