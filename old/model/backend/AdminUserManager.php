<?php

namespace model\backend;


class AdminUserManager extends Manager
{
    //from connect.php
    public function getUser($pseudo, $password)
    {
        //utilisation de la clé de salage
        $password = hash('sha256', $this->salt . $password);
        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $requser->execute(array($pseudo, $password));
        return $requser;
    }
}
