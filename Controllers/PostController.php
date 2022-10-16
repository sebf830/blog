<?php
namespace App\Controllers;

use App\core\View;
use App\Helpers\Mail;
use App\Form\ContactForm;
use App\Repository\PostRepository;
use App\Form\Validator\ContactValidator;
use App\Repository\SocialNetworkRepository;


class PostController{

    public function index($urlParam){

        $socialnetworks = (new SocialNetworkRepository)->findAll();

        $posts = (new PostRepository)->findAll();

        return View::render('post/index.html.php', [
            "socials" => $socialnetworks,
            "posts" => $posts
        ]);
    }

    public function show($postId){

        $socialnetworks = (new SocialNetworkRepository)->findAll();

        return View::render('home.html.php', [
            "socials" => $socialnetworks,
        ]);
    }
}