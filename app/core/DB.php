<?php
class DB extends PDO
{
    private static $instance = null;
    public static function getInstance()
    {
        if(self::$instance == null){
            $base = App::config('database');
            $dsn = 'mysql:host='.$base['server'].';dbname='. $base['name'].';';
            self::$instance = new PDO($dsn, $base['user'], $base['password']);
            self::$instance -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        }
        return self::$instance;
    }
}