<?php

namespace App\core;

class View
{
    public static function render(string $vue, array $array = null): void
    {
        if ($array != null) {
            foreach ($array as $key => $value) {
                $data[$key] = $value;
            }
            extract($data);
        }
        include 'Views/templates/' . $vue;
    }
}
