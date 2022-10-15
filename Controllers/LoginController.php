<?php
namespace App\Controllers;

use App\core\View;
use App\Form\RegisterForm;
use App\Form\Validator\RegisterValidator;
use App\Repository\SocialNetworkRepository;


class LoginController{

    public function index(){

        $socialnetworks = (new SocialNetworkRepository)->findAll();

        return View::render('login.html.php', [
            "socials" => $socialnetworks,
        ]);
    }
}