<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

define('PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', __DIR__. DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);
define('IMAGE_PATH', __DIR__. DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
define('PDF_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pdf' . DIRECTORY_SEPARATOR);

$path= implode(PATH_SEPARATOR,
[
    APP_PATH . 'models',
    APP_PATH . 'controller',
    APP_PATH . 'core',
    APP_PATH . 'helpers'
]);

set_include_path($path);


spl_autoload_register(function($class){

    $path = explode(PATH_SEPARATOR, get_include_path());
    foreach ($path as $key) {
        if(file_exists($key. DIRECTORY_SEPARATOR. $class . '.php')){
            include $key. DIRECTORY_SEPARATOR. $class . '.php';
            break;
        }
    }

});

App::start();