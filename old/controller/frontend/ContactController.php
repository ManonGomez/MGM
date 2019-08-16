<?php

namespace controller\frontend;

class ContactController extends MainController
{

    public  function contact()
    {
        if (isset($_POST['formcontact'])) {
            $origin = "Contact Billet simple pour l'Alaska";
            $sujet = htmlspecialchars($_POST['subject']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $text = htmlspecialchars($_POST['message']);

            if (!empty($pseudo) and !empty($mail) and !empty($sujet) and !empty($text)) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
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
                    $contenu .= '<p>' . $text . '</p></body>';
                    $contenu .= '</html>';
                    // erreur à ce niveau
                    mail($for, $contenu, $headers);

                    $message = 'Votre message à bien été envoyé.';
                } else {
                    $error = 'Erreur dans l\'adresse mail';
                }
            } else {
                $error = 'Veuillez remplir tous les champs';
            }
        }
        require('view/frontend/template_contact.php');
    }
}
