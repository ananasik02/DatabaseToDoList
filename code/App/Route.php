<?php


namespace App;


class Route
{
    public static function get($uri, $action)
    {
        if($_SERVER['REQUEST_URI'] == $uri){
            require $_SERVER['DOCUMENT_ROOT'] . $action;
        }
    }
}