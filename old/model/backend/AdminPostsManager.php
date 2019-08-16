<?php

namespace model\backend;


class AdminPostsManager extends Manager
{

    public function getNameArticle($IDdelete)
    {

        $bdd = $this->dbConnect();
        $namearticle = $bdd->prepare('SELECT title FROM articles WHERE Id=?');
        $namearticle->execute(array($IDdelete));
        return $namearticle;
    }

    public function getArticleBYDate()
    {
        $bdd = $this->dbConnect();
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }

    public function getArticleById($id)
    {

        $bdd = $this->dbConnect();
        $article = $bdd->prepare('SELECT * FROM articles WHERE Id=?');
        $article->execute(array($id));
        return $article->fetch();
    }

    public  function createArticle($titlearticle, $textarticle)
    {
        $bdd = $this->dbConnect();
        $insertarticle = $bdd->prepare("INSERT INTO articles (title, text, dateArticle) VALUES (?, ?, NOW())");
        $insertarticle->execute(array($titlearticle, $textarticle));
        return $bdd->lastInsertId();
    }

    public function upadteArticle($titlearticle, $txt, $id)
    {
        $bdd = $this->dbConnect();
        $uparticle = $bdd->prepare('UPDATE articles SET title=?, text=?, dateArticle=NOW()  WHERE Id=?');
        $uparticle->execute(array($titlearticle, $txt, $id));
        return $uparticle;
    }

    public  function deleteArticle($IDdelete)
    {

        $bdd = $this->dbConnect();
        $delete = $bdd->prepare('DELETE FROM articles WHERE Id=?');
        $delete->execute(array($IDdelete));
        return $delete;
    }
}
