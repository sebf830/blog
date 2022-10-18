<?php

namespace App\Helpers;

class Sanitizer
{
    public static function sanitize(string $string, ?string $cast = null)
    {
        $string = strip_tags(trim($string));

        if($cast = 'int'){
            return (int)$string;
        }

        return (string)$string;
    }
}