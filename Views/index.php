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
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Login</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <form action="<?php echo FRONT_ROOT . 'Login/Login ' ?>" method="POST" class="bg-light-alpha p-5">
                            <?= isset($errorIncorrectLogin) ? $errorIncorrectLogin : "" ?>
                            <?= isset($errorNotLogged) ? $errorNotLogged : "" ?>
                            <div class="form-group">
                                <h5 for="email">Ingrese su correo</h5>
                                <input type="text" id="email" name="email" value="" class="form-control" placeholder="Ingresar mail..." required>
                            </div>           
                            <button type="submit" class="btn btn-dark ml-auto d-block">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>