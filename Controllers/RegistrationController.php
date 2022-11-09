<?php
namespace App\Controllers;

use App\core\View;
use App\Models\User;
use App\Form\RegisterForm;
use App\Helpers\StringHelper;
use App\Repository\UserRepository;
use App\Form\Validator\RegisterValidator;
use App\Repository\SocialNetworkRepository;

class RegistrationController{

    public function index($urlParam){

        $socialnetworks = (new SocialNetworkRepository)->findAll();
        $registerForm = (new RegisterForm)->build();

        if(isset($_POST) && !empty($_POST)){

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
            $user->setFirstname(isset($_POST['firstname']) ? StringHelper::sanitize($_POST['firstname']) : null);
            $user->setLastname(isset($_POST['lastname']) ? StringHelper::sanitize($_POST['lastname']) : null);
            $user->setEmail(isset($_POST['email']) ? StringHelper::sanitize($_POST['email']) : null);
            $user->setRole('user');
            $user->setPassword(isset($_POST['password']) ? password_hash(StringHelper::sanitize($_POST['password']), PASSWORD_DEFAULT) : null);

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