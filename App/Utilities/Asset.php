<?php
namespace App\Utilities;

class Asset{
    public static function get(string $route){
        return $_ENV['BASE_URL'] . 'assets/' . $route;
    }

    public static function css(string $route){
        return $_ENV['BASE_URL'] . 'assets/css' . $route;
    }


    
}

