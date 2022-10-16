<?php

namespace App\Form\Validator;

class CommentValidator
{
    public static function checkForm($form, $data): array
    {
        $errors = [];

        foreach ($form["inputs"] as $name => $input) {
            if (!isset($data[$name])) {
                $errors[] = "Il manque le champ :" . $name;
            }

            if (!empty($input["required"]) && empty($data[$name])) {
                $errors[] = $name . " ne peut pas être vide";
            }

            if(isset($input['min']) && strlen($data[$name]) < $input['min'] 
            || isset($input['max']) && strlen($data[$name]) > $input['max']){
                $errors[] = $input["error"] ;

            }
        }
        return $errors;
    }
}