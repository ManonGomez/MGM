<?php

namespace model\frontend;



class CommentsManager extends Manager
{

    public function getComments($IDarticle)
    {

        $bdd = $this->dbConnect();
        $comment = $bdd->prepare("SELECT * FROM comments WHERE IdArticle = ? ORDER BY dateComment DESC");
        $comment->execute(array($IDarticle));
        return $comment;
    }

    public function getCommentID()
    {

        $bdd = $this->dbConnect();
        $reqIDcomment = $bdd->query('SELECT Id FROM comments WHERE Id=(SELECT MAX(Id) FROM comments)');
        return $reqIDcomment;
    }

    public function postComment($idArticle, $author, $comment)
    {

        $bdd = $this->dbConnect();
        $comments = $bdd->prepare('INSERT INTO comments(text, dateComment, pseudo, IdArticle) VALUES(?,NOW(), ?,?)');
        $affectedLines = $comments->execute(array($comment, $author, $idArticle));

        return $affectedLines;
    }
    public function signalCom($idComment)
    {
        $bdd = $this->dbConnect();
        //UPDATE Orders SET Quantity = Quantity + 1 WHERE ...
        $rateCom = $bdd->prepare("UPDATE comments SET rate = rate + 1 WHERE Id=?");
        $rateCom->execute(array($idComment));
        return $rateCom;
    }
}
