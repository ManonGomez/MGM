<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Crew\Unsplash\User;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdminController extends Controller {

    /**
     * Page de login
     */
    public function dashboard(RequestInterface $request, ResponseInterface $response, $args) {
        //var_dump($args['id']);die();
        $this->render($response, 'admin/pages/home.twig');
    }

 
}