<?php
require_once('nav.php');

if (isset($_SESSION["loginError"])) {
    $errorIncorrectLogin = '<h5 class="text-danger">Los datos ingresados son inválidos.</h5>';
    unset($_SESSION["loginError"]);
}

    if (isset($_SESSION["validateError"])){
        if($_SESSION["validateError"]==0){
            ?>
            <div class="text-succes">
            <h4>La empresa se ha registrado de forma exitosa !! Puede ingresar a través del Login </h4>
             </div>
            <?php
        }elseif ($_SESSION["validateError"]==1){
            ?>
            <div class="text-danger">
            <h4>Formato de datos ingresados no permitido</h4>
             </div>
            <?php
        }elseif ($_SESSION["validateError"]==2){
            ?>
            <div class="text-danger">
            <h4>La empresa ya se encuentra registrada</h4>
             </div>
            <?php
    
        }else {
            /*...*/
        }}


?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container bg-light-alpha p-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Login</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <form action="<?php echo FRONT_ROOT . 'Login/Login ' ?>" method="POST">
                            <h5>Ingrese su correo</h5>
                            <div class="input-group">
                                <input type="text" id="email" name="email" value="" class="form-control" placeholder="Ingresar mail..." required>
                                <button type="submit" class="btn btn-dark ml-auto d-block ml-2">Ingresar</button>
                            </div>
                            <?= isset($errorIncorrectLogin) ? '<h5 class="mt-2">'. $errorIncorrectLogin .'</h5>' : "" ?>
                        </form>
                        <div class="d-flex justify-content-end mt-3">
                    <a href="<?php echo FRONT_ROOT . 'Register/ShowCompanyRegisterView' ?>" class="btn btn-primary">Registrarse como compania</a> 
                    
                </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        
    </section>
</main>