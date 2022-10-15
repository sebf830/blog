<?php  

namespace App\Form;

class ContactForm{

    public function build($params = null){
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "contact-form",
                "class" => "mx-auto",
            ],
            "inputs" => [
                "firstname" => [
                    "label" => "Prénom",
                    "placeholder" => "Votre prénom ...",
                    "type" => "text",
                    "id" => "contact-firstname",
                    "class" => "contact-input form-control",
                    "min" => 2,
                    "max" => 200,
                    "error" => " Votre prénom doit faire entre 2 et 200 caractères",
                ],
                "lastname" => [
                    "label" => "Nom",
                    "placeholder" => "Votre nom ...",
                    "type" => "text",
                    "id" => "contact-lastname",
                    "class" => "contact-input form-control",
                    "min" => 2,
                    "max" => 200,
                    "error" => " Votre nom doit faire entre 2 et 200 caractères",
                ],
                "email" => [
                    "label" => "Email",
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "contact-email",
                    "class" => "contact-input form-control",
                    "required" => true,
                    "error" => "Email incorrect"
                ],
                "message" => [
                    "label" => "Message",
                    "placeholder" => "Votre message ...",
                    "type" => "textarea",
                    "id" => "contact-message",
                    "class" => "contact-input form-control",
                    "required" => true,
                    "min" => 2,
                    "max" => 4000,
                    "error" => " Votre nom doit faire entre 2 et 400 caractères",
                ]
            ]
        ];
    }
}