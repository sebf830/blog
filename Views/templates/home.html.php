<?php ob_start(); ?>

<p><?= $salut ?></p>
<p><?= strtoupper($seb) ?></p>
<p>param : <?= $id ?>


<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>