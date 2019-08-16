<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<div class="container">
    <section id="top">
        <p>Bienvenue sur mon blog, retrouvez mon livre "Billet simple pour l'Alaska" chapître par chapître juste ici ! N'hésitez pas à me laisser un commentaire</p>

        <?php while ($showarticles = $articles->fetch()) { ?>
           <div class="card">
                <div class="card-header">
                <h2><a href="index.php?action=post&id=<?= $showarticles['Id'] ?>"><?= htmlspecialchars($showarticles['title']); ?></a></h2>
               </div>
               <div class="card-body">
                <p><?= htmlspecialchars_decode($showarticles['text']) ?></p>
                <p><?= $showarticles['dateArticle'] ?></p>
               </div>
            </div>
        <?php } ?>
        <!-- {} permet defaire du php sur plusieurs lignes toujours dans la boucle while-->
    </section>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
