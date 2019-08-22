<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdmonOfferController extends Controller {

    public  function afficheOffer()
    {

        //faire appel a function getOffer
        //relier w/template
    }
    public function reponseOffer(){
        if(isset($_POST[valider])){
            $pseudo=$_SESSION['pseudo'];
            $offer=$_SESSION['offer'];
        }
        if(isset($_POST[valider])){
            $pseudo=$_SESSION['pseudo'];
            $offer=$_SESSION['offer'];
        }
    }
  
}