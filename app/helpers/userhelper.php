<?php

class userhelper{

    public static function nameError(string $string){
        if(empty($string)){
            return 'Field cannot be empty';
        }else if(strlen($string) < 5 ){
            return 'Field must contain at least 5 characters';
        }else if(strlen($string) > 35 ){
            return 'Input is too long';
        }else if(preg_match('~[0-9]+~',$string)){
            return  'Only letters are allowed';
        }
        return '';
    }

    public static function emptyError(string $string){
        if(empty($string)){
            return 'Field cannot be empty';
        }
        return '';
    }

    public static function emailUpdateError($newEmail,$oldEmail){
        $UsersClass = static::shortSelect('Users','email',$newEmail);
        if(empty($newEmail)){
            return 'Field cannot be empty';
        }else if($newEmail != $oldEmail){
            if(!empty($UsersClass)){
                return 'Email exists';
            }
        }
        return '';

    }

    public static function emailError(string $email){
        $UsersClass = static::shortSelect('Users','email',$email);
        if(!empty($UsersClass)){
            return 'Email exists';
        }else if(empty($email)){
            return 'Field cannot be empty';
        }
        return '';
    }

    public static function passwordError(string $password, string $confirmPassword){

        if(empty($password) || empty($confirmPassword)){
            return 'Field cannot be empty';
        }else if($password != $confirmPassword){
            return 'Passwords not same';
        }else if(strlen($password) < 6){
            return 'Minimum 6 symbols';
        }else if(!preg_match('~[0-9]+~',$password)){
            return 'One symbol must be a number';
        }
        $passes=false;
        for ($i=0; $i < strlen($password) ; $i++) { 
            if(ctype_upper(substr($password, $i,1))){
                $passes=true;
            }
        }
        if($passes == false ){
            return 'One symbol must be a capital letter';
        }
        return '';
    }

    public static function loginErrors(string $email,string $password, array $errors){
        $UsersClass = static::shortSelect('Users','email',$email);
        isset($UsersClass-> password) ? $checkPassword = $UsersClass-> password : $checkPassword = '';
        if(empty($email)){
            $errors['email'] = 'Field cannot be empty';
        }else if(empty($UsersClass -> email)){
            $errors['email'] = 'Email does not exist';
        }else if(empty($password)){
            $errors['password'] = 'Field cannot be empty';
        }else if (!password_verify($password,$checkPassword)){
            $errors['password'] = 'Wrong password';
        }
        return $errors;
    }

    public static function setRemembermeToken($email){
        $User = static::shortSelect('Users','email',$email);
        $token = bin2hex(random_bytes(52));
        setcookie('CookieT/', $User->id.'.'.$token, time() + 3600 * 30);
        $UsersClass=new Users;
        $UsersClass -> rememberme_token =password_hash($token, PASSWORD_BCRYPT, ['cost' => 12]);
        $UsersClass -> where = $email;
        $UsersClass -> update('email');

    }

    public static function LoginWithCookie(){

        if(isset($_COOKIE['CookieT/'])){
            $cookie= explode('.',$_COOKIE['CookieT/']);
            $UsersClass = static::shortSelect('Users','id',$cookie[0]);
            if(isset($UsersClass->rememberme_token) && password_verify($cookie[1], $UsersClass->rememberme_token)){
            unset($UsersClass -> password);
            unset($UsersClass -> confirm_email_token);
            unset($UsersClass -> reset_password_token);
            unset($UsersClass -> rememberme_token);
            return $UsersClass;
            }
        }    
    }

    public static function forgotPassword($email)
    {
        $Selectresult = static::shortSelect('Users','email',$email);
        if(!empty($Selectresult)){
            $token=bin2hex(random_bytes(10)). '.' 
            . bin2hex(random_bytes(10)). '.'
            . bin2hex(random_bytes(10)). '.'
            . bin2hex(random_bytes(10)). '.'
            . bin2hex(random_bytes(10));
            $UsersClass = new Users;
            $UsersClass -> reset_password_token = $token;
            $UsersClass -> where = $email;
            $UsersClass -> update('email');
            $to      = $email;
            $subject = 'Reset password'; 
            $message = 'reset password on link '. App::config('url') . 'Login/resetPassword/'. $token;
            mailerhelper::sendmail($to,$subject,$subject,$message);
            return 'Please check email';
        }else{
            return "Email does not exists";
        }
    }

    public static function shortSelect($class,$where,$whereParam)
    {
        $instance = new $class;
        $instance -> where = $whereParam;
        if(!empty($instance -> select($where))){
            return $instance -> select($where)[0];
        }
    }

    public static function RedirectIfLogin()
    {
        if(Request::isLogin()){
            Request::redirect(App::config('url'));
        }
    }
}