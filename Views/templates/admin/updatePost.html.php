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
                    <p class="alert alert-success"> <?= $success ?> </p>
            <?php endif ?>

            <h1 class="main-heading">Modifier un post</h1>

            <?php View::renderForm("form",  $form) ?>

            <button type="submit" class="btn btn-secondary py-1 px-4 d-block mx-auto">valider</button>

            <?php View::endForm() ?>

        </div>
        </div>
    </div>
    </div>
</div>


<?php $baseAdmin = ob_get_clean(); ?>
<?php require('./Views/layout/base-admin.php'); ?>

<?php unset($_SESSION['flash']); ?>
