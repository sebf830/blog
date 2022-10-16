<?php
namespace App\Controllers;

use App\core\View;
use App\Helpers\Mail;
use App\Form\ContactForm;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
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

    public function show($slug){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $post = (new PostRepository)->findOneBy(['slug' => $slug])[0];

        $author = (new UserRepository)->findOneBy(['id' => 1])[0];


        return View::render('post/show.html.php', [
            "socials" => $socialnetworks,
            "post" => $post,
            "author" => $author
        ]);
    }
}