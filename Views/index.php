<?php
require_once('nav.php');

if (isset($_SESSION["loginError"])) {
    $errorIncorrectLogin = '<h5 class="text-danger">Los datos ingresados son inválidos.</h5>';
    unset($_SESSION["loginError"]);
}

if (isset($_SESSION["existingMail"])) {
    $errorExistingMail = '<h5 class="text-danger mt-3">Ya existe un usuario con ese mail registrado.</h5>';
    unset($_SESSION["existingMail"]);
}

if (isset($_SESSION["registerState"]) && $_SESSION["registerState"] == 0) {
    $registerState = '<h5 class="text-danger">Ocurrió un error al registrar el usuario.</h5>';
    unset($_SESSION["registerState"]);
}
else if (isset($_SESSION["registerState"]) && $_SESSION["registerState"] == 1) {
    $registerState = '<h5 class="text-success">El usuario ha sido registrado exitosamente. Ingresá para ver la información.</h5>';
    unset($_SESSION["registerState"]);
}
else { /***/ }
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container bg-light-alpha p-5">
            <div class="row">
                <?= isset($registerState) ? $registerState : "" ?>
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
                            <?= isset($errorIncorrectLogin) ? $errorIncorrectLogin : "" ?>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5>¿Todavía no tenés una cuenta?</h5>
                    <a href="<?php echo FRONT_ROOT.'Register/ShowRegisterView'?>" class="btn btn-primary mt-2">¡Registrate!</a>
                    <?= isset($errorExistingMail) ? $errorExistingMail : "" ?>
                </div>
            </div>
        </div>
    </section>
</main>