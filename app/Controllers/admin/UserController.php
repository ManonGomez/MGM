<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;
use App\Models\Admin\AdminUserManager;

class UserController extends Controller {

    /**
     * Page de login
     */
    public function connect(RequestInterface $request, ResponseInterface $response) {

        if ( isset($_SESSION['admin']) ) {
            $response = $response->withRedirect('/admin/dashboard');
            return $response;
        }
        
        $this->render($response, 'pages/login.twig');
    }

    public function logout(RequestInterface $request, ResponseInterface $response) {
        $_SESSION = array();
        session_destroy();
        $response = $response->withRedirect('/');
        return $response;
    }

    public function postConnect(RequestInterface $request, ResponseInterface $response) {

        $message = '';
        $pseudo = $request->getParam('pseudo');
        $password = $request->getParam('password');

        //https://respect-validation.readthedocs.io/en/1.1/
        //var_dump($request->getParams());die();

        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $passWordValidation = Validator::notEmpty()->validate($password);

        $userManager = new AdminUserManager();
        $requser = $userManager->getUser($pseudo, $password);
        $userexist = $requser->rowCount();
    
        if ( !$pseudoValidation || !$passWordValidation || $userexist !== 1) {
            $message = 'Identifiants incorrects';
            return $this->render($response, 'pages/login.twig', ['message' => $message]);
        }

        if ( $userexist === 1 )  {
            $_SESSION['admin'] = true;
            $response = $response->withRedirect('/admin/dashboard');
            return $response;
        }

        
    }
    public function register(RequestInterface $request, ResponseInterface $response){
        $message = '';
        $pseudo = $request->getParam('pseudo');
        $firstname = $request->getParam('firstname');
        $lastname = $request->getParam('lastname');
        $mail = $request->getParam('mail');
        $password = $request->getParam('password');

        $password = hash('sha256', $salt . $_POST['password']);

        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $firstnameValidation = Validator::notEmpty()->validate($firstname);
        $lastnameValidation = Validator::notEmpty()->validate($lastname);
        $mailValidation = Validator::notEmpty()->validate($mail);
        $passwordValidation = Validator::notEmpty()->validate($password);
         
        $userexist = $requser->rowCount();


                   
            $this->render($response, 'pages/.twig');  
    }

}