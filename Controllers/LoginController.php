<?php
namespace App\Controllers;

use App\core\View;
use App\core\Session;
use App\Form\LoginForm;
use App\Form\RegisterForm;
use App\Repository\UserRepository;
use App\Form\Validator\RegisterValidator;
use App\Repository\SocialNetworkRepository;

class LoginController{

    public function index(){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $loginForm = (new LoginForm)->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = [];

            $user = isset((new UserRepository)->findOneBy(['email' => $_POST['email']])[0]) ? 
                (new UserRepository)->findOneBy(['email' => $_POST['email']])[0] : null;

            if(!password_verify($_POST['password'], $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('register.html.php', [
                    "form" => $loginForm,
                    "socials" => $socialnetworks,
                    "validation" => $validation
                ]);
            }

            $session = new Session();
            $session->set('firstname',$_POST['firstname']);
            $session->set('lastname', $_POST['firstname']);
            $session->set('email', $_POST['email']);
            $session->set('role', $user->getRole());

            header('Location:/home');
        }

        return View::render('login.html.php', [
            "socials" => $socialnetworks,
            "form" => $loginForm
        ]);
    }

    public function logout()
    {
        session_destroy();
        session_unset();

        header('Location:/home');
    }
}