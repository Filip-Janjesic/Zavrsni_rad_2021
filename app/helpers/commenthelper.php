<?php 

class commenthelper
{

    public static function commentError(string $string){
        if(!isset($_SESSION['User'])){
            Request::redirect(App::config('url').'/login');
        }else if(empty($string)){
            return 'Field cannot be empty';
        }else if(strlen($string) < 2 ){
            return 'Field must contain at least 2 characters';
        }else if(strlen($string) > 500 ){
            return 'Comment is too long';
        }
        return '';
    }

}