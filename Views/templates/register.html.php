<?php  
use App\core\View;
ob_start(); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="card shadow-sm">
        <div class="card-body">

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

            <h1 class="main-heading">Inscription</h1>

            <?php View::renderForm("form",  $form) ?>
        
            <div class="row mb-0 mt-4">
                <div class="col-md-8 offset-md-3">
                <button type="submit" class="btn btn-secondary py-1 px-4">valider</button>

                <a class="text-decoration-none ps-4" href="/connexion">
                   J'ai déja un compte
                </a>
                </div>
            </div>

            <?php View::endForm() ?>

        </div>
        </div>
    </div>
    </div>
</div>






<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>

