<?php
namespace App\Controllers;

use App\core\View;
use App\Form\RegisterForm;
use App\Repository\UserRepository;
use App\Form\Validator\RegisterValidator;

class HomeController{

    public function index($urlParam){
        $salut = "salut";
        $seb = "seb";


        $userRepository = new UserRepository();
        $users = $userRepository->findAll(['id' => 1]);

        $form = (new RegisterForm())->build();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

           $validation = RegisterValidator::checkForm($form, $_POST);

           if(!empty($validation)){
            return View::render('home.html.php', [
                "salut" => $salut,
                "seb" => $seb,
                "urlParam" => $urlParam,
                "form" => $form,
                "errors" => $validation
            ]);
           }
        }


        return View::render('home.html.php', [
            "salut" => $salut,
            "seb" => $seb,
            "urlParam" => $urlParam,
            "form" => $form
        ]);
    }
}