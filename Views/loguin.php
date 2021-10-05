
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Loguin</h2>
               <form action="<?php echo FRONT_ROOT ?>Student/Loguin" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">User</label>
                                   <input type="email" name="userName" value="" class="form-control">
                              </div>
                         </div>
                        
                    </div>
                    <button type="submit" class="btn btn-dark ml-auto d-block">Loguin</button>
               </form>
          </div>
     </section>
     <?php
          if (isset ($message))
          echo $message;
     ?>

</main>