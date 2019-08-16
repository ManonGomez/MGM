<?php $title = 'Votre espace de gestion de commentaires'; ?>

<?php ob_start(); ?>
<section class="tablecom">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Commentaire</th>
                <th scope="col">valider</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($showcom = $comments->fetch()) { ?>
            <tr>
                <td scope="row"><a href="index.php?action=post&id=<?= $showcom['IdArticle'] ?>"><?= htmlspecialchars($showcom['text']); ?></a></td>
                <td><a href="index.php?action=admin&page=validcom&id=<?= $showcom['Id']?>"><button type="button" class="btn btn-success"><i class="fas fa-check"></i></button></a></td>
                 <td><a href="index.php?action=admin&page=deletecom&id=<?= $showcom['Id']?>"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
            </tr>
             <?php } ?>
        </tbody>
    </table>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>