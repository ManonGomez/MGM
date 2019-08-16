<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Controller {

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function render(ResponseInterface $response, $file, $args = array()) {
        
        $this->container->view->render($response, $file, $args);
    }
}