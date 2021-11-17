<?php
require_once('nav.php');

if (isset($_SESSION["loginError"])) {
    $errorIncorrectLogin = '<h5 class="text-danger">Los datos ingresados son inválidos.</h5>';
    unset($_SESSION["loginError"]);
}
if (isset($_SESSION["registerState"])){
    if($_SESSION["registerState"]==1){
        ?>
        <div class="text-succes">
        <h4>La empresa se ha registrado de forma exitosa !! </h4>
         </div>
        <?php
    }elseif ($_SESSION["registerState"]==0){
        ?>
        <div class="text-danger">
        <h4>La empresa no se ha podido registrar</h4>
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
                    </div>
                </div>
            </div>
            <hr>
        </div>
        
    </section>
</main>