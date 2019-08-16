<?php

namespace controller\frontend;

use model\frontend\PostsManager;


class MainController
{

    public function notFound()
    {

        header("HTTP/1.0 404 Not Found");
        require('view/frontend/404.php');
    }

    public function unauthorize()
    {
        header("HTTP/1.0 401 Unauthorized");
        require('view/frontend/unauthorize.php');
    }

    public function index()
    {
        $postManager = new PostsManager();
        $articles = $postManager->getArticles();

        require('view/frontend/template_index.php');
    }
}
