<?php


class categoryhelper{

    public static function addError(string $string){
        if(empty($string)){
            return 'Field cannot be empty';
        }else if(strlen($string) < 2 ){
            return 'Field must contain at least 2 characters';
        }else if(strlen($string) > 50 ){
            return 'Name is too long';
        }
        return '';
    }
}
