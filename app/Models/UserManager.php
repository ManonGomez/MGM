<?php

namespace App\Models\User;
use App\Models\Manager;

class UserManager extends Manager
{

    public function register($lastname, $firstname, $pseudo, $mail, $password)
    {

        $bdd = $this->dbConnect();
        $insertuser = $bdd->prepare("INSERT INTO users(latsname,firstname, pseudo, mail, password) VALUES(?, ?, ?, ?, ?)");
        $insertuser->execute(array($lastname, $firstname, $pseudo, $mail, $password));
        return $insertuser;
    }
    
    public function changes(){
        $bdd = $this->dbConnect();
        $changes = $bdd("UPDATE users SET pseudo=? & password=? WHERE Id=?")
    }
}