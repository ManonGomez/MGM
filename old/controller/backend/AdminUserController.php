<?php

namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostsManager;
use controller\frontend\MainController;
use model\frontend\CommentsManager;
use model\backend\AdminUserManager;

class AdminUserController extends MainController
{
    public function isAdmin()
    {
        if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function connect()
    {
        if (isset($_POST['formconnexion'])) {
            if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {

                $pseudo = $_POST['pseudo'];
                $password = $_POST['password'];

                $userManager = new AdminUserManager();
                $requser = $userManager->getUser($pseudo, $password);
                $userexist = $requser->rowCount();
                if ($userexist == 1) {
                    $userdata = $requser->fetch();

                    $_SESSION['username'] =  $userdata['username'];
                    $_SESSION['firstname'] =  $userdata['firstname'];
                    $_SESSION['lastname'] =  $userdata['lastname'];
                    $_SESSION['mail'] =  $userdata['mail'];
                    $_SESSION['admin'] =  $userdata['admin'];


                    if ($userdata['admin'] == 1) {
                        header("Location:  index.php?action=admin&page=dashboard");
                    } else {
                        header("Location:  index.php");
                    }
                } else {
                    $message = '<div class="alert alert-danger">identifiants incorrects</div>';
                    require 'view/backend/template_connect.php';
                }
            } else {
                $message = '<div class="alert alert-danger">identifiants incorrects</div>';
                require 'view/backend/template_connect.php';
            }
        } else {
            require 'view/backend/template_connect.php';
        }
    }

    public function disconnect()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }
}
