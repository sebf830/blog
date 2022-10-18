<?php
namespace App\Controllers;

use App\core\View;
use App\Models\User;
use App\Form\RegisterForm;
use App\Repository\UserRepository;
use App\Form\Validator\RegisterValidator;
use App\Repository\SocialNetworkRepository;

class RegistrationController{

    public function index($urlParam){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $registerForm = (new RegisterForm)->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$validation = RegisterValidator::checkForm($registerForm, $_POST);

			// send errors
			if ($validation && count($validation) > 0) {
				return View::render('register.html.php', [
                    "form" => $registerForm,
                    "validation" => $validation,
                    "socials" => $socialnetworks,
                ]);
			}

            $user = new User();
            $user->setFirstname(String::sanitize($_POST['firstname']));
            $user->setLastname(String::sanitize($_POST['lastname']));
            $user->setEmail(String::sanitize($_POST['email']));
            $user->setRole('user');
            $user->setPassword(password_hash(String::sanitize($_POST['password']), PASSWORD_DEFAULT));

            (new UserRepository)->persist($user);
            
            $success = 'Vous êtes inscrit sur le site, veuillez vous connecter ici : <a href="/connexion" ><small>connexion</small></a>';

            return View::render('register.html.php', [
                "form" => $registerForm,
                "success" => $success,
                "socials" => $socialnetworks,
            ]);
        }


        return View::render('register.html.php', [
            "form" => $registerForm,
            "socials" => $socialnetworks,
        ]);
    }
}