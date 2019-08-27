<?php

// Get container
$container = $app->getContainer();
$container['upload_directory'] = dirname(__DIR__). '/public/gallery';
chmod($container['upload_directory'], 0777);

// Register component on container
$container['view'] = function ($container) {

    $dir = dirname(__DIR__);

    $view = new \Slim\Views\Twig($dir . '/app/Views', [
        'cache' => false, //$dir . '/cache',
        'debug' => true,
    ]);
    $view->getEnvironment()->addExtension(new \Twig\Extension\DebugExtension());
    $view->getEnvironment()->addGlobal('session', $_SESSION);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};