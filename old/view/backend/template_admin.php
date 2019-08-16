<?php $title = 'Votre espace'; ?>


<?php ob_start(); ?>
<h2>Bienvenue Jean</h2>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Que voulez-vous faire ?</h3>
        <a href=" index.php?action=admin&page=listposts"> <input class="btn btn-outline-dark cursor" value="Gérer les articles"></a>
        <a href=" index.php?action=admin&page=gestioncom"><input class="btn btn-outline-dark cursor" value="Gérer les commentaires"></a>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
