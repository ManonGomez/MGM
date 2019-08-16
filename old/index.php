<?php
session_start();


use model\backend\Manager;
use controller\frontend\MainController;
use controller\frontend\PostsController;
use controller\frontend\CommentsController;
use controller\frontend\ContactController;
use controller\frontend\AboutController;
use controller\backend\AdminUserController;
use controller\backend\AdminCommentsController;
use controller\backend\AdminPostsController;
use controller\backend\AdminController;

require_once('SplClassLoader.php');
$autoLoader = new SplClassLoader();
$autoLoader->register();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            //appel du bon controller qui permet de gérer la homepage et la liste des posts
            $controller = new MainController();
            $controller->index();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostsController();
                $controller->showPost($_GET['id']);
            } else {
                //page d'erreur si l'actionn'hésite pas ou est incorrecte
                $controller = new MainController();
                $controller->notFound();
            }
        }
        //signalement des commentaires & affichage dans la modération admin
        elseif ($_GET['action'] == 'signalCom') {
            if (isset($_GET['idComment']) && $_GET['idComment'] > 0 && isset($_GET['idArticle']) && $_GET['idArticle'] > 0) {
                $controller = new CommentsController();
                $controller->signalComment($_GET['idComment'], $_GET['idArticle']);
            } else {
                $controller = new MainController();
                $controller->notFound();
            }
        }
        //ajout de commentaires
        elseif ($_GET['action'] == 'addComment') {

            //on vérifie la présence del'id dans l'url
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new CommentsController();
                $controller->addComment($_GET['id']);
            } else {
                $controller = new MainController();
                $controller->notFound();
            }
        } elseif ($_GET['action'] == 'contact') {
            $controller = new ContactController();
            $controller->contact();
        } elseif ($_GET['action'] == 'about') {
            $controller = new AboutController();
            $controller->about();
        } elseif ($_GET['action'] == 'connect') {

            $controller = new AdminUserController();
            $controller->connect();
        } elseif ($_GET['action'] == 'disconnect') {
            $AdminUserController = new AdminUserController();
            $AdminUserController->disconnect();
        }
        //boucle if pour tout ce qui concerne l'admin
        elseif ($_GET['action'] == 'admin') {

            $AdminUserController = new AdminUserController();
            $isAdmin = $AdminUserController->isAdmin();
            //on teste si l'utilisateur est bien connecté
            if ($isAdmin) {

                $controller = new AdminController();
                $AdminPostsController = new AdminPostsController();
                $AdminCommentsController = new AdminCommentsController();
                //page d'accueil de l'admin
                if ($_GET['page'] == 'dashboard') {
                    $controller->dashboard();
                }
                //liste des articles dans l'admin
                elseif ($_GET['page'] == 'listposts') {
                    $AdminPostsController->adminPosts();
                }
                //page de creation d'un billet
                elseif ($_GET['page'] == 'createpost') {
                    $AdminPostsController->createPost();
                }
                //page d'édition d'un post
                elseif ($_GET['page'] == 'editpost') {

                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $AdminPostsController->updatePost($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['page'] == 'deletepost') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $AdminPostsController->delete($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                }
                //page de suppression d'un commentaire
                elseif ($_GET['page'] == 'deletecom') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $AdminCommentsController->deletecom($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    //suppression du signalement d'un commentaire  
                } elseif ($_GET['page'] == 'validcom') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $AdminCommentsController->validcom($_GET['id']);
                    } else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
                    //liste de tous les commentaires àmodérer   
                } elseif ($_GET['page'] == 'gestioncom') {

                    $AdminCommentsController->gestioncom();
                } else {
                    header('Location: index.php?action=admin&page=dashboard');
                }
            }
            //sinon accès interdit
            else {
                $controller = new MainController();
                $controller->unauthorize();
            }
        } else {
            $controller = new MainController();
            $controller->notFound();
        }
    } else {
        $controller = new MainController();
        $controller->index();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getCode();
}
