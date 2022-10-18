<?php
namespace App\Controllers;

use App\core\View;
use App\core\Session;
use App\Form\LoginForm;
use App\Repository\UserRepository;
use App\Repository\SocialNetworkRepository;

class LoginController{

    public function index(){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $loginForm = (new LoginForm)->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = [];

            $user = isset((new UserRepository)->findOneBy(['email' => $_POST['email']])[0]) ? 
                (new UserRepository)->findOneBy(['email' => String::sanitize($_POST['email'])])[0] : null;

            if(!password_verify(String::sanitize($_POST['password']), $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('register.html.php', [
                    "form" => $loginForm,
                    "socials" => $socialnetworks,
                    "validation" => $validation
                ]);
            }

            $session = new Session();
            $session->set('firstname', String::sanitize($_POST['firstname']));
            $session->set('lastname', String::sanitize($_POST['firstname']));
            $session->set('email', String::sanitize($_POST['email']));
            $session->set('role', String::sanitize($user->getRole()), 'int');
            $session->set('id', String::sanitize($user->getid()), 'int');

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