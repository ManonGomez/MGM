<?php $title = 'Billet simple pour l\'Alaska'; ?>


<?php ob_start(); ?>

<h3>Modification des billets</h3>
<form method="post" class="billetform" action="index.php?action=admin&page=editpost&id=<?php echo $article['Id']; ?>">
    <input type="text" id="title" name="titlearea" value="<?= $article['title'] ?>">
    <textarea id="mytextarea" name="textarea"><?= $article['text'] ?></textarea>
    <input type="submit" id="send" name="billetup" value="Modifier" class="btn btn-outline-dark write">
    <?php
        if (isset($error)) {
            echo '<p>' . $error . '</p>';
        }
    ?>
</form>
<!--zone de texte avec l'api tinymce-->
<script>
    window.addEventListener('load', () => {
        tinymce.init({
            selector: '#mytextarea'
        });
    })
    
</script>

<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>