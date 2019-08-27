<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UnsplashController extends Controller
{
    public function __construct($container)
    {
        \Crew\Unsplash\HttpClient::init([
            'applicationId'    => '9bceaf5fc9f94ef1a2a0c427ee2d1bd44a4b4950ca1aec1f6372450319eb1b4a',
            'secret'        => '4530d84c27373bcf88e4cdab82da6110422a36a8921d861e14a554a87ad8283a',
            'utmSource' => 'mgm',
            'callbackUrl' => 'http://example.com'
        ]);
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
        $page = 3;
        $per_page = 15;
        $orientation = 'landscape';

        $data = \Crew\Unsplash\Search::photos($query, $page, $per_page, $orientation);
        $newResponse = $response->withJson($data->getResults());

        return $newResponse;
    }
}
