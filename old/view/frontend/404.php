<?php $title = "Page introuvable"; ?>

<?php ob_start(); ?>

<div>
    Cette page n'existe pas
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>