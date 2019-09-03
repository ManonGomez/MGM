<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ContactController extends Controller {

    public function contact(RequestInterface $request, ResponseInterface $response) {
        $pseudo = $request->getParam('pseudo');
        $mail = $request->getParam('mail');
        $sujet = $request->getParam('sujet');
        $text = $request->getParam('text');

        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $mailValidation = Validator::notEmpty()->validate($mail);
        $sujetValidation = Validator::notEmpty()->validate($sujet);
        $textValidation = Validator::notEmpty()->validate($text);

        $headers = 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
           $headers .= 'From: "' . $pseudo . '"<' . $mail . '>' . "\n";
           $headers .= 'Reply-To: ' . $mail . '' . "\n";

            $for = 'manon.gomez@chaffy.net';

            $contenu = '<html>';
            $contenu .= '<head><title>' . $origin . '</title></head>';
            $contenu .= '<body><h4>' . $pseudo . '</h4>';
          $contenu .= '<h5>' . $mail . '</h5>';
           $contenu .= '<h5>' . $sujet . '</h5>';
            $contenu .= '<h5>' . $tel . '</h5>';
           $contenu .= '<p>' . $text . '</p></body>';
           $contenu .= '</html>';
            mail($for, $contenu, $headers);

        $this->render($response, '/pages/contact.twig', ['name' => 'Marc']);
    }
}

