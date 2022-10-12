<?php
namespace App\Controllers;

use App\core\Sql;
use App\core\View;
use App\Repository\UserRepository;
use App\Models\User;

class HomeController{

    public function index($urlParam){
        $salut = "salut";
        $seb = "seb";


        $userRepository = new UserRepository();
        $users = $userRepository->findAll(['id' => 1]);


        return View::render('home.html.php', [
            "salut" => $salut,
            "seb" => $seb,
            "urlParam" => $urlParam
        ]);
    }
}