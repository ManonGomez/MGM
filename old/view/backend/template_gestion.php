<?php $title = 'Votre espace de gestion d\'articles'; ?>


<?php ob_start(); ?>
<section class="createbutton">
    <div>
       <a href="index.php?action=admin&page=createpost"> <button type="button" id="topb" class="btn btn-info" >Ecrire un article</button></a>
       <!-- modifier le href avec index.php etc... -->
        <a href="index.php?action=admin&page=gestioncom"><button type="button" id="topb" class="btn btn-primary">Modérer les commentaires</button></a>
    </div>
</section>
<section class="table">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Article</th>
                <th scope="col">Lire</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
                <?php while ($showarticles = $articles->fetch()) { ?>
            <tr>
                <td scope="col"><a href="index.php?action=post&id=<?= $showarticles['Id'] ?>"><?= $showarticles['title'] ?></a></td>
                <td><a href="index.php?action=post&id=<?= $showarticles['Id'] ?>"><button type="button" class="btn btn-success"><i class="fas fa-book-open"></i></button></a></td>
                <td><a href="index.php?action=admin&page=editpost&id=<?= $showarticles['Id'] ?>"><button type="button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button></a></td>
                <td><a href="index.php?action=admin&page=deletepost&id=<?= $showarticles['Id'] ?>"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
                 </tr>
                   <?php } ?>
        </tbody>
    </table>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>