<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-4">Ingrese el ID de la compañia que desea eliminar</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="<?= FRONT_ROOT ?>Company/DeleteCompany" method="post">
                        <input type="number" name="id-company">
                        <button type="submit" class="btn btn-primary" style="margin-left: 3px;">Eliminar</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="<?= FRONT_ROOT.'Administrator/ShowPanelView'; ?>" class="btn btn-primary">Volver</a>
                </div>
            </div>
            <?php
            require_once('company-list.php');
            ?>
        </div>

    </section>
</main>