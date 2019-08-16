<?php
session_start();

require '../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);

require('../app/container.php');

require('../app/routes/routes.php');

$app->run();