<?php

namespace App\Models\Admin;
use App\Models\Manager;

class AdminUserManager extends Manager
{

    public function getUser($pseudo, $password)
    {

        $password = hash('sha256', $this->salt . $password);
        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $requser->execute(array($pseudo, $password));
        return $requser;
    }

}
