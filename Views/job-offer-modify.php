<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Modificando Ofertas de trabajo</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffer/ModifyJobOffer" method="post" class="bg-light-alpha p-5">
                    <input type="hidden" name="joboffer-id" value="<?= $_SESSION["actual_company"] ?>">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Posicion de trabajo</label>
                                   <input type="text" name="jobPosition" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha de comienzo</label>
                                   <input type="date" name="dateCreation" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Fecha Limite</label>
                                   <input type="date" name="dateLimit" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Description</label>
                                   <input type="text" name="description" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Compañia</label>
                                   <input type="file" name="company" value="" class="form-control">
                              </div>
                         </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="<?php echo FRONT_ROOT . 'Administrator/ShowPanelView' ?>" class="btn btn-primary">Volver</a> 
                        <button type="submit" class="btn btn-dark ml-auto d-block">Modificar</button>
                    </div>
               </form>
          </div>
     </section>
     <?php
          if (isset ($message))
          echo $message;
     ?>

</main>