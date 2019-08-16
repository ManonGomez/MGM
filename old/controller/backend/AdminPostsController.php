<?php

namespace controller\backend;

use model\backend\Manager;
use controller\frontend\MainController;
use model\frontend\CommentsManager;
use model\backend\AdminPostsManager;
use model\backend\AdminCommentsManager;

class AdminPostsController extends MainController
{
    public  function adminPosts()
    {

        $postsManager = new AdminPostsManager();
        $articles = $postsManager->getArticleBYDate();

        require('view/backend/template_gestion.php');
    }



    public function createPost()
    {
        $postsManager = new AdminPostsManager();

        //faire page pour ecrire
        if (isset($_POST['billetvalid'])) {
            if (!empty($_POST['textarea']) and !empty($_POST['titlearea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $textarticle = htmlspecialchars($_POST['textarea']);

                $insertarticle = $postsManager->createArticle($titlearticle, $textarticle);
                // -> = pour preparer et executer la bdd
                $message = "L'article à bien été posté";
                header("Location:  index.php?action=admin&page=listposts&page=editpost&id=" . $insertarticle);
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }

        require('view/backend/template_create.php');
    }


    public function updatePost($idPost)
    {
        $postsManager = new AdminPostsManager();
        $article = $postsManager->getArticleById($idPost);

        if (isset($_POST['billetup'])) {
            if (!empty($_POST['titlearea']) and !empty($_POST['textarea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $txt = htmlspecialchars($_POST['textarea']);

                $uparticle = $postsManager->upadteArticle($titlearticle, $txt, $idPost);
                header("Location:  index.php?action=admin&page=listposts&page=editpost&id=" . $idPost);
            } else {
                $error = 'Veuillez remplir tous les champs';
                header("Location:  index.php?action=admin&page=editpost&page=editpost&id=" . $idPost);
            }
        }

        require('view/backend/template_updatearticle.php');
    }

    public function delete($idPost)
    {
        $postsManager = new AdminPostsManager();
        $AdminCommentsManager = new AdminCommentsManager;
        $article = $postsManager->getArticleById($idPost);

        if (!$article) {
            throw new \Exception('Ce billet n\'existe pas');
        }

        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['valid'])) {
            header("Location: index.php?action=admin&page=listposts");
        }

        if (isset($_POST['delete'])) {
            $delete = $postsManager->deleteArticle($idPost);
            $deleteAllCom = $AdminCommentsManager->deleteComWithArticle($idPost);
            //supprime les commentaires liés a l'article supprimé
            header("Location: index.php?action=admin&page=listposts");
        }

        require('view/backend/template_delete.php');
    }
}
