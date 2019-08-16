<?php
use App\Controllers\IndexController;
use App\Controllers\ContactController;
use App\Controllers\PhotosController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\AdminController;

//frontend
$app->get('/', IndexController::class . ':index');
$app->get('/photographie', PhotosController::class . ':indexPhotos')->setName('photograhpy');
$app->get('/contact', ContactController::class . ':contact')->setName('contact');

$app->get('/mgm_connect', UserController::class . ':connect')->setName('connect');

$app->post('/mgm_connect', UserController::class . ':postConnect');
$app->get('/logout', UserController::class . ':logout')->setName('logout');

//admin
//middleware pour verifier la session admin
$checkSession = function($request, $response, $next) {
    if ( isset($_SESSION['admin']) ) {
        $response = $next($request, $response);
    }
    else {
        $response = $response->withRedirect('/');
    }

    return $response;
};

$app
    ->group('/admin', function () use ($app) {
        $app->get('/dashboard', AdminController::class . ':dashboard');
    })
    ->add($checkSession);