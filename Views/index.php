<?php
    require_once('nav.php');
    
    if (isset($_SESSION["loginError"])) {
        $errorIncorrectLogin = '<h5 class="text-danger">Los datos ingresados son inválidos.</h5>';
    }
    
    if (isset($_SESSION["notLogged"])) {
        $errorNotLogged = '<h5 class="text-danger">Debes iniciar sesión antes de ingresar al sistema.</h5>';
    }
?>
<main class="py-5">
<section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">login</h2>
               <div class="content text-center">
               <form action="<?php echo FRONT_ROOT.'Login/Login '?>" method="POST" class="bg-light-alpha p-5">
                    <?= isset($errorIncorrectLogin) ? $errorIncorrectLogin : "" ?>
                    <?= isset($errorNotLogged) ? $errorNotLogged : "" ?>
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