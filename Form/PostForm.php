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
                    "value" => isset($params['title']) ? $params['title'] : ''
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
                    "value" => isset($params['chapo']) ? $params['chapo'] : ''

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
                    "value" => isset($params['content']) ? $params['content'] : ''

                ],
                "tags" => [
                    "label" => "tags",
                    "placeholder" => "Renseigner des tags séparés par un #",
                    "type" => "text",
                    "id" => "post-tags",
                    "class" => "post-input form-control",
                    "min" => 2,
                    "max" => 1000,
                    "error" => "Le titre doit faire entre 2 et 1000 caractères",
                    "value" => isset($params['tags']) ? $params['tags'] : ''

                ],
            ]
        ];
    }
}