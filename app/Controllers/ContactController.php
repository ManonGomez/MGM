<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\ConfigApp;

class ContactController extends Controller
{

    public function contact(RequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, '/pages/contact.twig');
    }

    public function contactPost(RequestInterface $request, ResponseInterface $response)
    {
        $pseudo = $request->getParam('pseudo');
        $email = $request->getParam('email');
        $topic = $request->getParam('topic');
        $message = $request->getParam('message');

        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $emailValidation = Validator::email()->validate($email);
        $topicValidation = Validator::notEmpty()->validate($topic);
        $messageValidation = Validator::notEmpty()->validate($message);

        $configApp = new ConfigApp();
        $confMail = $configApp->get('mail');

        if ($pseudoValidation and $emailValidation and $topicValidation and $messageValidation) {
            //create PHPMailer instance
            $mail = new PHPMailer;
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;
            $mail->Host = 'node-email-1.pulsepanel.eu';
            // if your network does not support SMTP over IPv6
            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = $confMail['user'];
            //Password to use for SMTP authentication
            $mail->Password = $confMail['password'];
            $mail->setFrom($email, 'Expediteur');
            $mail->addAddress('manon.gomez@chaffy.net', 'Manon');
            $mail->Subject = $topic;
            $mail->Body = $message;
            if (!$mail->send()) {
                return $this->render($response, '/pages/contact.twig', ['message' => "Votre message n'a  pas pu être envoyé.", "type" => "error"]);
            } else {
                return $this->render($response, '/pages/contact.twig', ['message' => "Votre message a bien été envoyé", "type" => "success"]);
            }
        }

        $this->render($response, '/pages/contact.twig', ['message' => "Votre message n'a  pas pu être envoyé."]);
    }
}
