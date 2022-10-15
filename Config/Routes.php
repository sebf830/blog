<?php
namespace App\Config;

class Routes{

  # route configuration
  # array(path, controller, method, role)
  public static function getRoutes(){
    return [
      "hello" => ["controller" => "home", "action" => "index", "role" => ["user"]],
      "" => ["controller" => "home", "action" => "index", "role" => ["user"]],
      "home" => ["controller" => "home", "action" => "index", "role" => ["user"]],
      "resume" => ["controller" => "home", "action" => "resume", "role" => ["user"]],
      "inscription" => ["controller" => "registration", "action" => "index", "role" => ["user"]],
      "connexion" => ["controller" => "login", "action" => "index", "role" => ["user"]],
    ];
  } 
}
