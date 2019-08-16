<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostsManager;
use controller\frontend\MainController;
use model\frontend\CommentsManager;
use model\backend\AdminCommentsManager;

class AdminCommentsController extends MainController
{
    public  function gestioncom()
    {

        $AdminCommentsManager = new AdminCommentsManager();
        $comments = $AdminCommentsManager->getCOMBYDate();
        require('view/backend/template_gestioncom.php');
    }

    public function validcom($idComment)
    {

        $AdminCommentsManager = new AdminCommentsManager();
        $txtcomment = $AdminCommentsManager->getComByID($idComment);


        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
            $AdminCommentsManager = new AdminCommentsManager();
            $rate0 = $AdminCommentsManager->validComment($idComment);

            header("Location:  index.php?action=admin&page=gestioncom");
        }
        require('view/backend/template_validcom.php');
    }

    public function deletecom($idComment)
    {

        $AdminCommentsManager = new AdminCommentsManager();
        $txtcomment = $AdminCommentsManager->gettextcom($idComment);


        if (isset($_POST['valid'])) {
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        if (isset($_POST['delete'])) {
            var_dump('dddd');
            $AdminCommentsManager = new AdminCommentsManager();

            $delete = $AdminCommentsManager->deleteCom($idComment);
            header("Location:  index.php?action=admin&page=gestioncom");
        }

        require('view/backend/template_deletecom.php');
    }
}
