<?php $title = 'Connectez-vous'; ?>



<?php ob_start(); ?>
<form method="post" class="connexion">

    <h6 class="card-title">Connectez-vous</h6>
    
    <div class="form-group">
        <label for="exampleFormControlInput1">Pseudo</label>
        <input class="field form-control" type="text" name="pseudo" id="pseudo" required="" autofocus="">
    </div>


    <div class="form-group">
        <label for="exampleFormControlInput1">Mot de passe</label>
        <input class="field form-control" type="password"  name="password" id="password">
    </div>

    <input class="btn btn-outline-dark" id="send" name="formconnexion" type="submit" value="Se connecter">
    <?php

    if (isset($message)) {
        echo $message;
    }

    ?>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>