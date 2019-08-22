<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class OfferController extends Controller {
public function ask{
    if(isset($_POST[create])){
        $pseudo=$_SESSION['pseudo'];
        $offer="creation";
        //relie avce askoffer
    }
    
    if(isset($_POST[maintenance])){
        $pseudo=$_SESSION['pseudo'];
        $offer="maintenace";
    }
    
    if(isset($_POST[graphic])){
        $pseudo=$_SESSION['pseudo'];
        $offer="graphique";
    }
    
    if(isset($_POST[shooting])){
        $pseudo=$_SESSION['pseudo'];
        $offer="shooting";
    }
    
    if(isset($_POST[retouch])){
        $pseudo=$_SESSION['pseudo'];
        $offer="retouche";
    }
}



}