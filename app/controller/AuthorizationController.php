<?php


class AuthorizationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['User'])){
            $this -> view -> render('login/login',[
                'errors' => [
                    'email' => '',
                    'password' => '',
                    'alert' => 'For this content you must be logged in!'],
                'returnField' => [
                    'email' => '',
                    'password' => '']
            ]);
            exit;
        }
    }
}

