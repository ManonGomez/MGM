<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PhotosController extends Controller {

    public function indexPhotos(RequestInterface $request, ResponseInterface $response) {
        $this->render($response, '/pages/photos.twig', ['name' => 'Marc']);
    }
    
}