<?php  
use App\core\View;
ob_start(); ?>

    <div class="container">
        <div class="py-5 px-3 mb-4 mt-5">
            <div class="box-text text-center" style="min-height:60vh; margin-top:10vh">
                <h1 class="display-5 fw-bold text-center">Sébastien Flouvat</h1>
                <p class="fs-4 text-center">Le développeur PHP dont vous ne pourrez plus vous passer.</p>
                <p class="fs-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum</p>
                <a href="/resume" class="btn btn-outline-dark btn-lg text-center" type="button">Mon CV</a>
                <a href="#ankle-form" class="btn btn-outline-dark btn-lg text-center scroll" type="button">Ecrivez-moi</a>
             </div>

             <div id="ankle-form" class="mb-5"></div>
             <div class="contain mt-5">
                <div class="form-wrapper bg-light py-3" id="form-wrapper" >

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

                    <h4 class="contact-title my-2 text-center">Contact</h4>
                    <?php View::renderForm("form",  $form) ?>
                        <input type="submit" class="btn btn-secondary mb-3 d-block mx-auto" id="contact-button" value="Envoyer" />
                    <?php View::endForm() ?>
                </div>
            </div>
        </div>  
    </div>

<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>



