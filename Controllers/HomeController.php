<?php
namespace App\Controllers;

use App\core\View;
use App\Form\RegisterForm;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\PostsTagsRepository;
use App\Form\Validator\RegisterValidator;
use App\Repository\SocialNetworkRepository;

class HomeController{

    public function index($urlParam){

        $posts = (new PostRepository())->findAll();

        $socialnetworks = (new SocialNetworkRepository)->findAll();

        return View::render('home.html.php', [
            "posts" => $posts,
            "socials" => $socialnetworks
        ]);
    }

    public function resume(){

        $file = '/public/uploads/fichier.pdf'; 
            
        header('Content-type: application/pdf'); 
        header('Content-Disposition: attached; filename="' . $file . '"'); 
        header('Content-Transfer-Encoding: binary'); 
        header('Accept-Ranges: bytes');    
    }
}