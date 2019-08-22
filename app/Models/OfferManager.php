<?php

namespace App\Models\User;
use App\Models\Manager;

class OfferManager extends Manager
{
    public function askOffer($pseudo,$offer)
    {
        $bdd = $this->dbConnect();
        $askOffer = $bdd->prepare("INSERT INTO offerRequest(pseudo, offer, step) VALUES(?,?,0)");
        $askOffer->execute(array($pseudo,$offer));
        return $askOffer;
    }
    public function recoveredvalidOffer()
    {
        $bdd = $this->dbConnect();
        $recoveredvalidOffer = $bdd->query('SELECT * FROM offerRequest WHERE step=1');
        return $recoveredvalidOffer;
    }

}