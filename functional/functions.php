<?php

use App\core\View;

function dd($value = null):void
{
    echo '<pre style="background-color: black; margin:30px 20px 0 20px;color: #1DF133;">';
    var_dump($value);
    echo '</pre>';
    die();
}

function displayError(?int $code):void
{
    if(ENVIRONMENT == 'prod'){
        http_response_code($code);
        $file = 'Views/errors/' . $code . '.php';
        if (file_exists($file)) {
            View::render($file);
        }
        die();
    }
}