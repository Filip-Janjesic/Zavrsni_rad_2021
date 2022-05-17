<?php

class Request
{
    public static function getRoute()
    {
        if(isset($_SERVER['REDIRECT_URL'])){
            $Route = $_SERVER['REDIRECT_URL'];
        }elseif(isset($_SERVER['REDIRECTION_PATH_INFO']))
        {
            $Route = $_SERVER['REDIRECTION_PATH_INFO'];
        }elseif(isset($_SERVER['REQUEST_URI']))
        {
            $Route = $_SERVER['REQUEST_URI'];
        }
        return $Route;
    }

    public static function isLogin()
    {
        return isset($_SESSION['User']);
    }

    public static function isAdmin()
    {
        if(isset($_SESSION))
    }
}
