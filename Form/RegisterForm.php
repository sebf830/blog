<?php  

namespace App\Form;

class RegisterForm{

    public function build($params = null){
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "formRegister",
                "class" => "formRegister"
            ],
            "inputs" => [
                "firstname" => [
                    "label" => "Prénom",
                    "placeholder" => "Votre prénom ...",
                    "type" => "text",
                    "id" => "firstnameRegister",
                    "class" => "register-input form-control",
                    "min" => 2,
                    "max" => 25,
                    "error" => " Votre prénom doit faire entre 2 et 25 caractères",
                ],
                "lastname" => [
                    "label" => "Nom",
                    "placeholder" => "Votre nom ...",
                    "type" => "text",
                    "id" => "lastnameRegister",
                    "class" => "register-input form-control",
                    "min" => 2,
                    "max" => 100,
                    "error" => " Votre nom doit faire entre 2 et 100 caractères",
                ],
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
                ],
                "passwordConfirm" => [
                    "label" => "Confirmation du mot de passe",
                    "placeholder" => "Confirmation ...",
                    "type" => "password",
                    "id" => "passwordConfirmRegister",
                    "class" => "register-input form-control",
                    "required" => true,
                    "error" => "Votre confirmation de mot de passe ne correspond pas",
                    "confirm" => "password"
                ]
            ]
        ];
    }
}