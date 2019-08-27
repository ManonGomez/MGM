<?php

namespace App\Models\Admin;

use App\Models\Manager;

class AdminPhotosManager extends Manager
{

    public function addPhoto($path)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("INSERT INTO photos (path) VALUES (?)");
        $req->execute(array($path));
        return $bdd->lastInsertId();
    }

    public function getNbPhotos() {
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT COUNT(*) as nbPhotos FROM photos');
        return $req->fetch();
    }

    public function getAllPhotos()
    {
        $bdd = $this->dbConnect();
        $req = $bdd->query("SELECT * FROM photos");
        return $req;
    }
    public function getAllPhotosWithPagination($firstIndexForPage, $nbByPage) 
    {
        $bdd = $this->dbConnect();
        $req = $bdd->query("SELECT * FROM photos LIMIT ".$firstIndexForPage.", ".$nbByPage."");
        return $req;
    }

    public function deletePhoto($id)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("DELETE FROM photos WHERE id = ?");
        $req->execute(array($id));
        return $req;
    }

    public function getPhotobyId($id)
    {

        $bdd = $this->dbConnect();
        $req = $bdd->prepare("SELECT * FROM photos WHERE id = ?");
        $req->execute(array($id));
        return $req->fetch();
    }
}
