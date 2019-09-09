<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;

class ContactController extends Controller {

    public function contact(RequestInterface $request, ResponseInterface $response) {
        $this->render($response, '/pages/contact.twig');
    }

    public function contactPost(RequestInterface $request, ResponseInterface $response) {
        $pseudo = $request->getParam('pseudo');
        $mail = $request->getParam('mail');
        $topic = $request->getParam('topic');
        $message = $request->getParam('message');

        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $mailValidation = Validator::email()->validate($mail);
        $topicValidation = Validator::notEmpty()->validate($topic);
        $messageValidation = Validator::notEmpty()->validate($message);

        if ( $pseudoValidation AND $mailValidation AND $topicValidation AND $messageValidation ) {
            $sendEmail = mail('condette.jonathan@gmail.com', $topic, $message);
            if ( $sendEmail ) {
                return $this->render($response, '/pages/contact.twig', ['message' => "Le message a bien été envoyé"]);
            }
        }

        $this->render($response, '/pages/contact.twig', []);
    }
}

