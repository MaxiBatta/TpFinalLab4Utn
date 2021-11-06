<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregando Empresa</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="name">Nombre</label>
                                   <input type="text" name="name" id= "name" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="yearFoundation">Año de fundacion</label>
                                   <input type="datetime-local" name="yearFoundation" id = "yearFoundation" value="" class="form-control" min="1950-01-01" step="1" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group"> 
                                   <label for="city">Ciudad</label>
                                   <input type="text" name="city" id= "city" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="descripcion">Descripcion</label>
                                   <input type="text" name="description" id= "descripcion" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="logo">Logo</label>
                                   <input type="file" name="logo" id="logo" value="" class="form-control">
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="email">Email</label>
                                   <input type="email" name="email" id="email" value="" class="form-control" minlength="16" maxlength="40" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="phoneNumber">Numero de Celular</label>
                                   <input type="text" name="phoneNumber" id="phoneNumber" value="" class="form-control" minlength="10" required>
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