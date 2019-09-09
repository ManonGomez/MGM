<?php
use App\Controllers\IndexController;
use App\Controllers\ContactController;
use App\Controllers\PhotosController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdminPhotosController;
use App\Controllers\Admin\UnsplashController;

//frontend
$app->get('/', IndexController::class . ':index');
$app->get('/photographie', PhotosController::class . ':indexPhotos')->setName('photograhpy');

$app->get('/contact', ContactController::class . ':contact')->setName('contact');
$app->post('/contact', ContactController::class . ':contactPost');

$app->get('/mgm_connect', UserController::class . ':connect')->setName('connect');
$app->post('/mgm_connect', UserController::class . ':postConnect');

$app->get('/mgm_register', UserController::class . ':register')->setName('register');
$app->post('/mgm_register', UserController::class . ':postRegister');

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
        $app->get('/dashboard', AdminController::class . ':dashboard')->setName('dashboard');
        $app->get('/manage/photos', AdminPhotosController::class . ':index')->setName('manage_photos');
        $app->post('/manage/photos', AdminPhotosController::class . ':uploadPhoto');
        $app->post('/manage/photos/delete', AdminPhotosController::class . ':deletePhoto')->setName('delete_photo');

        $app->get('/gallery[/{page}]', AdminPhotosController::class . ':userGallery')->setName('user_gallery')->setArguments(['page' => 1]);
        $app->get('/unsplashgallery', UnsplashController::class . ':userUnsplashGallery')->setName('user_unsplashgallery');
//récupère la requête 
        $app->get('/photosFromUnsplash/{query}', UnsplashController::class . ':getPhotosFromUnsplash');
        //récupère la page de la requête
        $app->get('/photosFromUnsplash/{query}/{page}', UnsplashController::class . ':getPhotosFromUnsplash');
    })
    ->add($checkSession);