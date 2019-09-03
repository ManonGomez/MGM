<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;
use App\Models\Admin\AdminPhotosManager;
use Exception;

class AdminPhotosController extends Controller
{

    protected $photoManager;

    function __construct($container)
    {
        //appel du constructeur parent
        parent::__construct($container);
        $this->photoManager = new AdminPhotosManager();
    }

    /**
     * Page de gestion des photos
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {

        if (isset($_SESSION['admin']) && $_SESSION['role'] !== 'ADMIN') {
            $response = $response->withRedirect('/admin/dashboard');
            return $response;
        }

        $photosList = array();
        $photosList = $this->getAllPhotos();
        $this->render($response, 'admin/pages/manage_photos.twig', ['photoList' => $photosList]);
    }

    public function uploadPhoto(RequestInterface $request, ResponseInterface $response)
    {
        $image = new \Bulletproof\Image($_FILES);
        $image->setLocation('gallery');
        $image->setDimension(100000, 10000); 
        //1 000 000 bytes = 10 mo
        $image->setSize(0, 10000000);
        if ($image["pictures"]) {
            $upload = $image->upload();

            if ($upload) {
                $path = $upload->getFullPath();
                $addPhoto = $this->photoManager->addPhoto($path);
                return $response->withRedirect('/admin/manage/photos');
            } else {
                echo $image->getError();
            }
        }
    }

    public function getAllPhotos()
    {
        $photoManager = new AdminPhotosManager();
        $photos = $photoManager->getAllPhotos()->fetchAll();
        return $photos;
    }

    public function deletePhoto(RequestInterface $request, ResponseInterface $response)
    {

        if ($request->getParam('id') !== null) {

            $id = $request->getParam('id');
            $photo = $this->photoManager->getPhotobyId($id);
            if (file_exists($photo['path'])) {
                unlink($photo['path']);
                $delete = $this->photoManager->deletePhoto($id);
                return $response->withRedirect('/admin/manage/photos');
            } else {
                throw new Exception('Erreur lors de la suppression du fichier');
            }
        }

        return $response->withRedirect('/admin/manage/photos');
    }

    public function userGallery(RequestInterface $request, ResponseInterface $response, $args)
    {
        $page = $args['page'];
        $nbByPage = 3;
        $nbPhotos = $this->photoManager->getNbPhotos()['nbPhotos'];
        $nbPages = ceil($nbPhotos / $nbByPage );
        $firstPhotoForPage = ($page - 1) * $nbByPage;

        if (( $page > $nbPages || $page < 1) && $nbPages > 0 ){
            return $response->withRedirect('/admin/gallery/1');
        }
        $photosList = $this->photoManager->getAllPhotosWithPagination($firstPhotoForPage, $nbByPage)->fetchAll();
        return $this->render($response, 'pages/account/gallery.twig', ['photosList' => $photosList, 'nbPages' => $nbPages, 'currentPage' => $page]);
    }
}
