<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MemberController extends Controller {


    public function member(RequestInterface $request, ResponseInterface $response) {

        $this->render($response, '/pages/member.twig', ['name' => 'Marc']);
    }
    
    public function offre(){
        
    }
}