<?php $title = $article['title']; ?>

<?php ob_start(); ?>


<div class="articleComplet">
    <h2><?= $article['title'] ?></h2>
    <p><?= htmlspecialchars_decode($article['text']) ?></p>
    <p><?= $article['dateArticle'] ?></p>
</div>


<form method="post" class="commentform" action="index.php?action=addComment&id=<?php echo $article['Id']?>">

    <div class="form-group">
        <label for="exampleFormControlInput1"></label>
        <input class="field form-control" type="text" name="pseudo" id="pseudo"  placeholder="Pseudo" value="">
    </div>

    <div class="form-group">
        <label for="exampleFormControlInput2"></label>
        <textarea name="text" id="message" class="form-control" rows="3" placeholder="Votre commentaire"></textarea>
    </div>

    <input type="submit" id="send" name="formcomment" value="Commenter" class="btn btn-outline-dark">

    <?php

    if (isset($message)) {
        echo $message;
    }

    ?>

</form>


<?php while ($commentDisplay = $comments->fetch()) { ?>
<div class="card text-center">
    <div class="card-body">
    <!--htmlspecialchars convertit les caractères spéciaux en entités HTML=code sécurisé-->
        <h3 class="card-title"><?= htmlspecialchars($commentDisplay['pseudo']); ?></h3>
        <p class="card-text"><?= htmlspecialchars($commentDisplay['text']) ?></p>
        <p class="card-text"><?= $commentDisplay['dateComment'] ?></p>
        <form method="post" action="index.php?action=signalCom&idComment=<?php echo $commentDisplay['Id']?>&idArticle=<?php echo $article['Id']?>">
            <input type="submit" class="btn btn-danger" value="Signaler" name="signalCom">
        </form>
    </div>
</div>
<?php } ?>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>
