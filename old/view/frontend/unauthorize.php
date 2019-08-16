<?php $title = "Accès non authorisé"; ?>

<?php ob_start(); ?>

<div>
    Accès non authorisé
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>