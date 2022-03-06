<?php

    error_reporting(0);
    $user = "afrodita"; // Mysql user
    $pass = "t84durft1994"; // Mysql pass
    $db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, 't84durft1994');

class Request
{
    public static function pathInfo()
    {
        if (isset($_SERVER['PATH_INFO'])) 
        {
            return $_SERVER['PATH_INFO'];
        } elseif (isset($_SERVER['REDIRECT_PATH_INFO'])) 
        {
            return $_SERVER['REDIRECT_PATH_INFO'];
        } else {
            return '';
        }
    }
    public static function post($key, $default = '')
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
}