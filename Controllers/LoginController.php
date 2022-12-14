<?php
namespace App\Controllers;

use App\core\View;
use App\core\Session;
use App\Form\LoginForm;
use App\Helpers\StringHelper;
use App\Repository\UserRepository;
use App\Repository\SocialNetworkRepository;

class LoginController{

    public function index(){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $loginForm = (new LoginForm)->build();

        if(isset($_POST) && !empty($_POST)){

			$validation = [];

            $email = isset($_POST['email']) ? StringHelper::sanitize($_POST['email']) : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;

            $user = isset((new UserRepository)->findOneBy(['email' => $email])[0]) ? 
                (new UserRepository)->findOneBy(['email' => $email])[0] : null;

            if(!password_verify($password, $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('register.html.php', [
                    "form" => $loginForm,
                    "socials" => $socialnetworks,
                    "validation" => $validation
                ]);
            }
            
            $session = new Session();
            $session->set('firstname', $user->getFirstname());
            $session->set('lastname', $user->getLastname());
            $session->set('email', $user->getEmail());
            $session->set('role', $user->getRole());
            $session->set('id', $user->getId());

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