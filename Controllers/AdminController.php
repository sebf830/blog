<?php
namespace App\Controllers;

use App\core\View;
use App\core\Session;
use App\Helpers\Mail;
use App\Form\LoginForm;
use App\Form\ContactForm;
use App\Repository\UserRepository;
use App\Form\Validator\ContactValidator;
use App\Repository\SocialNetworkRepository;


class AdminController{

    public function connexion($urlParam){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = [];

            $user = isset((new UserRepository)->findOneBy(['email' => $_POST['email']])[0]) ? 
                (new UserRepository)->findOneBy(['email' => $_POST['email']])[0] : null;

            if(!password_verify($_POST['password'], $user->getPassword())){

                $validation[] = "identifiants non reconnus";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation
                ]);
            }

            if($user->getRole() != 'admin'){
                $validation[] = "Vous ne disposez pas des droits pour acceder à cet espace";

                return View::render('admin/login.html.php', [
                    "form" => (new LoginForm)->build(),
                    "validation" => $validation
                ]);
            }

            $session = new Session();
            $session->set('firstname',$_POST['firstname']);
            $session->set('lastname', $_POST['firstname']);
            $session->set('email', $_POST['email']);
            $session->set('role', $user->getRole());

            header('Location:/dashboard');
        }

        return View::render('admin/login.html.php', [
            "form" => (new LoginForm)->build()
        ]);
    }

    public function dashboard(){

        return View::render('admin/dashboard.html.php', []);
    }
}