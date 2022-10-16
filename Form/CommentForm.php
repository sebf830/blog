<?php  

namespace App\Form;

class CommentForm{

    public function build($params = null){
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "comment-form",
                "class" => "mx-auto",
            ],
            "inputs" => [
                "title" => [
                    "label" => "title",
                    "placeholder" => "Donnez un titre à votre commentaire",
                    "type" => "text",
                    "id" => "comment-title",
                    "class" => "comment-input form-control",
                    "min" => 2,
                    "max" => 200,
                    "error" => "Le titre doit faire entre 2 et 200 caractères",
                ],
                "content" => [
                    "label" => "content",
                    "placeholder" => "Votre commentaire ici",
                    "type" => "text",
                    "id" => "comment-content",
                    "class" => "comment-input form-control",
                    "min" => 2,
                    "max" => 4000,
                    "error" => " Votre message doit faire entre 2 et 4000 caractères",
                ]
            ]
        ];
    }
}