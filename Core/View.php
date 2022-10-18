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
        include 'Views/templates/'. $vue;
    }

    public static function renderForm($partial, $form): void
    {
        if (file_exists("Views/partials/{$partial}.php")) {
            
            include "views/partials/{$partial}.php";
        }
    }

    public static function endForm(): void
    {
       echo '</form>';
    }
}
