<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Ingrese el ID de la compañia que desea Reactivar </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= FRONT_ROOT ?>Company/ActiveCompany" method="post">
                        <input type="number" name="id-company">
                        <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Reactivar</button>
                    </form>
                </div>
            </div>
            <?php
            $_SESSION["activeCondition"] = 2;
            require_once('company-list.php');
            ?>
        </div>

    </section>
</main>