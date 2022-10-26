<?php

namespace App\Helpers;

class StringHelper
{
    public static function sanitize($var)
    {
        $var = (string)$var;

        return strip_tags(htmlspecialchars(trim($var)));
    }
}