<?php

namespace App\Helpers;

class Slugger
{
    public static function sluggify($title): string
    {
        $chars = [
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'Œ' => 'oe', 'Ē' => 'e',
            'À' => 'a', 'à' => 'a', 'â' => 'a', 'ä' => 'a', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ô' => 'o', 'ö' => 'o', 'ò' => 'o', 'û' => 'u', 'ù' => 'u', 'û' => 'u', ',' => ' ',
            '&' => '-', '\"' => '', '\'' => '', '§' => '', '!' => '', '?' => '', '%' => '',
            '$' => '', '€' => '', '£' => '', '/' => '-', '(' => '-', ')' => '-', '_' => '-',
            '`' => '-', '+' => '-', '=' => '-',  ';' => '-', ':' => '-', '^' => '',
            '<' => '', '>' => '', '@' => '', '#' => '', '°' => '', '*' => '', ' ' => '-'
        ];

        $title = strtolower(trim($title));
        $title_chars = str_split($title);

        $expected_chars = [];
        for ($i = 0; $i < count($title_chars); $i++) {
            foreach ($chars as $key => $value) {
                if ($title_chars[$i] == $key) {
                    $expected_chars[] = $value;
                }
            }
            $expected_chars[] = $title_chars[$i];
        }

        $slug =  implode('', $expected_chars);
        $slug = str_replace(' ', '', $slug);
        return $slug;
    }
}