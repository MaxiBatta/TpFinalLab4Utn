<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Ingrese el ID de la job offer que desea eliminar</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="<?= FRONT_ROOT ?>JobOffer/DeleteJobOffer" method="post">
                        <input type="number" name="id-job-offer">
                        <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Eliminar</button>
                    </form>
                </div>
            </div>
            <?php
            $_SESSION["activeCondition"] = 1;
            require_once('job-offer-list.php');
            ?>
        </div>

    </section>
</main>