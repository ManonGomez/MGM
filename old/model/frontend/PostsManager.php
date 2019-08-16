<?php

namespace model\frontend;


class PostsManager extends Manager
{

    public function getArticle($IDarticle)
    {
        $bdd = $this->dbConnect();
        $article = $bdd->prepare("SELECT * FROM articles WHERE Id = ?");
        $article->execute(array($IDarticle));

        return $article->fetch();
    }

    public function getArticles()
    {

        $bdd = $this->dbConnect();
        //asc = tri croissant
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }
}
