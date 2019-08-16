<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<?php while ($showcom = $txtcomment->fetch()) { ?>

<h3>Voulez-vous supprimer <?= htmlspecialchars($showcom['text']); ?> ?</h3>
<form method="post">
    <input type="submit" id="send" name="valid" value="Non" class="btn btn-outline-dark">
</form>
<form method="post">
    <input type="submit" id="send" name="delete" value="Oui" class="btn btn-outline-dark">
</form>
<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>