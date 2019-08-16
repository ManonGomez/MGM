<?php

namespace controller\frontend;

use model\frontend\PostsManager;
use model\frontend\CommentsManager;


class PostsController extends MainController
{



    public function showPost($idPost)
    {
        $postManager = new PostsManager();
        $commentManager = new CommentsManager();
        $message = '';

        $article = $postManager->getArticle($idPost);
        $comments = $commentManager->getComments($idPost);
        //verifie la présence ou non d'un message temporaire et on le supprime ensuite
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        //test si l'article a bien été trouvé en base
        // si non, on revoi une erreur
        if ($article) {
            require('view/frontend/template_article.php');
        } else {
            $this->notFound();
        }
    }


    public function listPosts()
    {
        $postManager = new PostsManager();
        $articles = $postManager->getArticles();
        require('view/frontend/template_index.php');
    }




    public function Post()
    {
        $postManager = new PostsManager();

        $IDarticle = $_GET['id'];
        $article = $postManager->getArticle($IDarticle);
        $comment = getComments($IDarticle);

        if ($_SESSION['admin'] == 0) {
            if (isset($_POST['formcomment'])) {
                $textcomment = htmlspecialchars($_POST['message']);
                if (!empty($textcomment)) {

                    $textcommentlenght = strlen($textcomment);
                    if ($textcommentlenght <= 110 and $textcommentlenght >= 4) {
                        $insertcom = $bdd->prepare("INSERT INTO comments(text, dateComment, pseudo) VALUES(?, NOW(), ?)");
                        $insertcom->execute(array($textcomment, $pseudocomment));
                        $reqIDcomment = getCommentID();
                        while ($reqID = $reqIDcomment->fetch()) {
                            $IDcomment = $reqID['Id'];
                        }
                        $message = 'Votre commentaire à été publié';
                    } else {
                        $error = 'Le commentaire doit comprendre au minimum 4 cractères et au maximum 110';
                    }
                } else {
                    $error = 'Veuillez compléter tous les champs';
                }
            }
        }


        require('view/frontend/template_article.php');
    }
}
