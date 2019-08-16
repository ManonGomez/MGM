<?php $title = 'Billet simple pour l\'Alaska'; ?>


<?php ob_start(); ?>

<h3>Voulez-vous supprimer <?= htmlspecialchars($article['title']); ?> ?</h3>
<form method="post">
    <input type="submit" id="valid" name="valid" value="Non" class="btn btn-outline-dark">
</form>
<form method="post">
    <input type="submit" id="delete" name="delete" value="Oui" class="btn btn-outline-dark">
</form>

<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>