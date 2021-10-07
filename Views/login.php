
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">login</h2>
               <div class="content text-center">
               <form action="<?php echo FRONT_ROOT.'Login/Login '?>" method="POST" class="bg-light-alpha p-5">
                    
                              <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="text" name="email" value="" class="form-control" placeholder="Ingresar email" required>
                              </div>
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="password" placeholder="contraseña" class="form-control" required>
                              </div>
                        
                    <button type="submit" class="btn btn-dark ml-auto d-block">Login</button>
               </form>
          </div>
          </div>
     </section>
     <?php
          if (isset ($message))
          echo $message;
     ?>

</main>
