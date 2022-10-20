<?php
namespace App\Config;

class Routes{

  # route configuration
  # array(path, controller, method, role)
  public static function getRoutes(){
    return [
      // hompeage
      "" => ["controller" => "home", "action" => "index", "role" => ["public", "admin"]],
      "home" => ["controller" => "home", "action" => "index", "role" => ["public", "admin"]],
      "resume" => ["controller" => "home", "action" => "resume", "role" => ["public", "admin"]],

      // signin/signup
      "inscription" => ["controller" => "registration", "action" => "index", "role" => ["public", "admin"]],
      "connexion" => ["controller" => "login", "action" => "index", "role" => ["public", "admin"]],
      "logout" => ["controller" => "login", "action" => "logout", "role" => ["user", "admin"]],

      // posts
      "posts" => ["controller" => "post", "action" => "index", "role" => ["public", "admin"]],
      "post" => ["controller" => "post", "action" => "show", "role" => ["public", "admin"]],

      // admin
      "connexion-admin" => ["controller" => "admin", "action" => "connexion", "role" => ["public"]],
      "dashboard" => ["controller" => "admin", "action" => "dashboard", "role" => ["admin"]],
      "creer-un-post" => ["controller" => "admin", "action" => "createPost", "role" => ["admin"]],
      "modifier-un-post" => ["controller" => "admin", "action" => "showPosts", "role" => ["admin"]],
      "modifier" => ["controller" => "admin", "action" => "updatePost", "role" => ["admin"]],
      "delete-post" => ["controller" => "admin", "action" => "deletePost", "role" => ["admin"]]
    ];
  } 
}
