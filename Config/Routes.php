<?php
namespace App\Config;

class Routes{

  # route configuration
  # array(path, controller, method, role)
  public static function getRoutes(){
    return [
      // hompeage
      "" => ["controller" => "home", "action" => "index", "role" => ["user"]],
      "home" => ["controller" => "home", "action" => "index", "role" => ["user"]],
      "resume" => ["controller" => "home", "action" => "resume", "role" => ["user"]],

      // signin/signup
      "inscription" => ["controller" => "registration", "action" => "index", "role" => ["user"]],
      "connexion" => ["controller" => "login", "action" => "index", "role" => ["user"]],
      "logout" => ["controller" => "login", "action" => "logout", "role" => ["user"]],

      // posts
      "posts" => ["controller" => "post", "action" => "index", "role" => ["user"]],
      "post" => ["controller" => "post", "action" => "show", "role" => ["user"]],

      // admin
      "connexion-admin" => ["controller" => "admin", "action" => "connexion", "role" => ["admin"]],
      "dashboard" => ["controller" => "admin", "action" => "dashboard", "role" => ["admin"]]

    ];
  } 
}
