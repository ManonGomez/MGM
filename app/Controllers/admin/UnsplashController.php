<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\ConfigApp;

class UnsplashController extends Controller
{
    public function __construct($container)
    {
        //une classe qui permet d'externaliser la config
        $configApp = new ConfigApp();
        $confUnsplash = $configApp->get('unsplash');
        //Lien vers la ressource github de unsplash php https://github.com/unsplash/unsplash-php
        \Crew\Unsplash\HttpClient::init($confUnsplash);
        $httpClient = new \Crew\Unsplash\HttpClient();
        $scopes = ['public'];

        parent::__construct($container);
    }

    public function userUnsplashGallery(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'pages/account/unsplash.twig');
    }

    public function getPhotosFromUnsplash(RequestInterface $request, ResponseInterface $response, $args)
    {   
        $query = $args['query'];
        $page = 1;
        $per_page = 15;
        $orientation = 'landscape';

        if ( isset($args['page']) ) {
            $page = $args['page'];
        }
        // comment effcetuer une recherche de photos via ce lien https://github.com/unsplash/unsplash-php#search
        $data = \Crew\Unsplash\Search::photos($query, $page, $per_page, $orientation);

        $responseData = array(
            'total' => $data->getTotal(),
            'totalPage' => $data->getTotalPages(),
            'results' => $data->getResults(),
            'page' => $page
        );
        $newResponse = $response->withJson($responseData);


        return $newResponse;
    }
}
