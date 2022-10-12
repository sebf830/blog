<?php
namespace App\Controllers;

use App\core\View;
use App\Form\RegisterForm;
use App\Repository\TagRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Repository\PostsTagsRepository;
use App\Form\Validator\RegisterValidator;

class HomeController{

    public function index($urlParam){

        $posts = (new PostRepository())->findAll();

        return View::render('home.html.php', [
            "posts" => $posts
        ]);
    }
}