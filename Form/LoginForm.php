<?php  

namespace App\Form;

class LoginForm{

    public function build($params = null){
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formLogin",
                "class" => "formLogin"
            ],
            "inputs" => [
                
                "email" => [
                    "label" => "Email",
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "register-input form-control",
                    "required" => true,
                    "error" => "Email incorrect",
                    "unicity" => true,
                    "errorUnicity" => "Un compte existe déjà avec cet email"
                ],
                "password" => [
                    "label" => "Mot de passe",
                    "placeholder" => "Votre mot de passe ...",
                    "type" => "password",
                    "id" => "passwordRegister",
                    "class" => "register-input form-control",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au min 8 caratères avec une majuscule et un chiffre"
                ]
            ]
        ];
    }
}