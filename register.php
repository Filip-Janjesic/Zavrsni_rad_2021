<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

    include_once "config.php";
    session_start();

    $term = $db->prepare("INSERT INTO farmers (opg, email, password,contactphone) VALUES
    (:opg, :email, :contactphone)");
    $term->bindValue('opg', Request::post("opg"));
    $term->bindValue('email', Request::post("email"));
    $term->bindValue('password', Request::post("password"));
    $term->bindValue('contactphone', Request::post("contactphone"));
    $term->execute();

    $_SESSION["email"]=Request::post("email");
    $_SESSION["password"]=Request::post("password");
    include_once "mainmenu.php";
?>
