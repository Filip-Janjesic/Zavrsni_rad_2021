<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php 

    include_once "config.php";
    session_start();

    $term = $db->prepare("SELECT COUNT(*) FROM farmers WHERE email=:email");
    $term->bindValue('email', Request::post("email"));
    $term->bindValue('password', Request::post("password"));
    $term->execute();
    $end=$term->fetchAll();

    if($end[0][0]==="0") {
        include_once "index.php";
    }else{
        $_SESSION["email"]=Request::post("email");
        $_SESSION["password"]=Request::post("password");
        include_once "mainmenu.php";
    }
    