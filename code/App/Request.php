<?php

class Request
{
    public static function uri()
    {
        var_dump(trim($_SERVER['REQUEST_URI'], '/'));
        return trim($_SERVER['REQUEST_URI'], '/');
    }
}