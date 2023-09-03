<?php
namespace App\Helpers;
class Custom{
    public static function uppercase(string $string=''):string
    {
        return strtoupper($string);
    }
}
