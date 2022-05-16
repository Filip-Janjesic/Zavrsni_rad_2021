<?php

class App
{

    public static function start()
    {

        $Route = explode('/', Request::getRoute());

        if(empty($Route[1])){
            $class = 'Index';
        }else{
            $class = ucfirst($Route[1]);
        }
        $class .= 'Controller';

        if(empty($Route[2])){
            $method = 'index';
        }else{
            $method = $Route[2];
        }
        $Route = array_slice($Route, 3);

        if(class_exists($class) && method_exists($class, $method)){
            $instance = New $class();
            $instance -> $method($Route);
        }else{
            $instance = New IndexController;
            $instance -> error([$class,$method]);
        }

    }

    public static function config(string $key) 
    {
        $config = include APP_PATH . 'config.php';
        return $config[$key];
    }

}
