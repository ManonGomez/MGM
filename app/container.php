<?php

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {

    $dir = dirname(__DIR__);

    $view = new \Slim\Views\Twig($dir . '/app/Views', [
        'cache' => false //$dir . '/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};