<?php 
use App\core\View;
ob_start(); 
?>

<p><?= $salut ?></p>
<p><?= strtoupper($seb) ?></p>
<p>param : <?= $urlParam ?>

<?php View::renderForm('form', $form) ?>


<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>

