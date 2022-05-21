<?php

class Users extends Model
{
    protected static $db_parameters = (['id','name', 'lastname', 'password', 'role', 'email', 'register_time', 'confirm_email_token', 'reset_password_token', 'rememberme_token','where']);
    protected static $db_table ='users';
    public $id;
    public $name;
    public $lastname;
    public $password;
    public $role;
    public $email;
    public $register_time;
    public $confirm_email_token;
    public $reset_password_token;
    public $rememberme_token;
    public $where;

    public static function readLimit($limt, $offset)
    {
        
    }
}