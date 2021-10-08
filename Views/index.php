<?php
    require_once('nav.php');
?>
<main class="py-5">
<section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">login</h2>
               <div class="content text-center">
               <form action="<?php echo FRONT_ROOT.'Login/Login '?>" method="POST" class="bg-light-alpha p-5">
                    
                              <div class="form-group">
                                   <label for="">email</label>
                                   <input type="text" name="email" value="" class="form-control" placeholder="Ingresar email" required>
                              </div>           
                    <button type="submit" class="btn btn-dark ml-auto d-block">Login</button>
               </form>
          </div>
          </div>
     </section>
</main>