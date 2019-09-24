<?php
namespace App\Controllers\Admin;
use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;
use App\Models\Admin\AdminUserManager;
use App\Models\Admin\AdminPhotosManager;
class UserController extends Controller {
    protected $photoManager;
    function __construct($container)
    {
        //appel du constructeur parent
        parent::__construct($container);
        $this->photoManager = new AdminPhotosManager();
    }
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
            $user = $requser->fetchObject();
            $_SESSION['admin'] = true;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['role'] = $user->role;
            $response = $response->withRedirect('/admin/dashboard');
            return $response;
        }
        
    }
    public function register(RequestInterface $request, ResponseInterface $response) {
        $this->render($response, 'pages/register.twig');
    }
    public function postRegister(RequestInterface $request, ResponseInterface $response) {
        $message = '';
        $pseudo = $request->getParam('pseudo');
        $password = $request->getParam('password');
        //https://respect-validation.readthedocs.io/en/1.1/
        $pseudoValidation = Validator::notEmpty()->validate($pseudo);
        $passWordValidation = Validator::notEmpty()->validate($password);
        $userManager = new AdminUserManager();
        $requser = $userManager->getUser($pseudo, $password);
        $userexist = $requser->rowCount();
        if( $userexist !== 1|| !$pseudoValidation || !$passWordValidation  ) {
            $userAdded= $userManager->addUser($pseudo, $password, 'USER');
            
            $userReq = $userManager->getUserById($userAdded);
            $user = $userReq->fetchObject();
            $_SESSION['admin'] = true;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['role'] = $user->role;
            return $response->withRedirect('/admin/dashboard');
        }
        else {
            $message = 'Identifiant déjà utilisé';
            return $this->render($response, 'pages/register.twig', ['message' => $message]);
        }
    }
}