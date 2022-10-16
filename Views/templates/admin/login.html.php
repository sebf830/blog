<?php 
use App\core\View;
ob_start(); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="card shadow-sm mt-5">
        <div class="card-body mt-5">

            <?php if (!empty($validation)) : ?>
                <div class="p-2 m-3" style="background:#ffb3b3;color:#cc0000;border:1px solid grey">
                    <?php foreach ($validation as $error) : ?>
                        <p> <?= $error ?> </p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <?php if (!empty($success)) : ?>
                <div class="p-2 m-3" style="background:lightgreen;color:green;border:1px solid grey">
                        <p> <?= $success ?> </p>
                </div>
            <?php endif ?>

            <h1 class="main-heading">Connexion admin</h1>

            <?php View::renderForm("form",  $form) ?>

                    <button type="submit" class="btn btn-secondary py-1 px-4 mt-3 mx-auto">valider</button>

            </div>

            <?php View::endForm() ?>

        </div>
        </div>
    </div>
    </div>
</div>

<?php $baseAdmin = ob_get_clean(); ?>
<?php require('./Views/layout/base-admin.php'); ?>
