<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class IndexController extends Controller {


    public function index(RequestInterface $request, ResponseInterface $response) {

        $this->render($response, '/pages/home.twig', ['name' => 'Marc']);
    }
    
}