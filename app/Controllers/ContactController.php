<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ContactController extends Controller {

    public function contact(RequestInterface $request, ResponseInterface $response) {
        $this->render($response, '/pages/contact.twig', ['name' => 'Marc']);
    }
}