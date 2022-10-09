<?php
namespace App\Controllers;

use App\core\View;

class HomeController{

    public function index($id){
        $salut = "salut";
        $seb = "seb";

        return View::render('home.html.php', [
            "salut" => $salut,
            "seb" => $seb,
            "id" => $id
        ]);
    }
}