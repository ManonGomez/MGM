<?php

namespace App\Models\Admin;
use App\Models\Manager;

class AdminOfferManager extends Manager
{

    
    public function getOffer()
    {
        $bdd = $this->dbConnect();
        $offerAdmin = $bdd->query('SELECT * FROM offerRequest WHERE step=0');
        return $offerAdmin;
    }
    public function deleteOffer()
    {
        $bdd = $this->dbConnect();
        $offerDelete = $bdd->query('DELETE * FROM offerRequest WHERE Id=?');
        return $offerDelete;
    }
    public function validOffer()
    {
        $bdd = $this->dbConnect();
        $validOffer = $bdd->query("INSERT INTO offerRequest(pseudo, offer, step) VALUES(?,?,1)");
        $validOffer->execute(array($pseudo,$offer));
        return $validOffer;
    }


}