<?php
namespace App\Models\Admin;
use App\Models\Manager;
class AdminUserManager extends Manager
{
    public function getUser($pseudo, $password)
    {
        $password = hash('sha256', $this->salt . $password);
        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("SELECT * FROM users WHERE pseudo = ? AND password = ?");
        $requser->execute(array($pseudo, $password));
        return $requser;
    }
    public function addUser($pseudo, $password, $role) {
        $password = hash('sha256', $this->salt . $password);
        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("INSERT INTO users (pseudo, password, role) VALUES (:pseudo, :password, :role) ");
        $requser->bindParam(':pseudo', $pseudo);
        $requser->bindParam(':password', $password);
        $requser->bindParam(':role', $role);
        $requser->execute();
        return $bdd->lastInsertId();
    }
    public function getUserById($id) {
        $bdd = $this->dbConnect();
        $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $requser->execute(array($id));
        return $requser;
    }
}