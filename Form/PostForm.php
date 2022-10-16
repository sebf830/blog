<?php  

namespace App\Form;

class PostForm{

    public function build($params = null){
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "contact-form",
                "class" => "mx-auto",
            ],
            "inputs" => [
                "title" => [
                    "label" => "title",
                    "placeholder" => "Renseigner un titre",
                    "type" => "text",
                    "id" => "post-title",
                    "class" => "post-input form-control",
                    "min" => 2,
                    "max" => 200,
                    "error" => "Le titre doit faire entre 2 et 200 caractères",
                ],
                "chapo" => [
                    "label" => "Chapo",
                    "placeholder" => "Renseigner un chapo",
                    "type" => "textarea",
                    "id" => "post-chapo",
                    "class" => "post-input form-control",
                    "required" => true,
                    "min" => 2,
                    "max" => 4000,
                    "error" => " Votre chapo doit faire entre 2 et 4000 caractères",
                ],
                "content" => [
                    "label" => "Contenu",
                    "placeholder" => "Renseigner un contenu",
                    "type" => "textarea",
                    "id" => "post-content",
                    "class" => "post-input form-control",
                    "required" => true,
                    "min" => 2,
                    "max" => 4000,
                    "error" => " Votre contenu doit faire entre 2 et 4000 caractères",
                ]
            ]
        ];
    }
}