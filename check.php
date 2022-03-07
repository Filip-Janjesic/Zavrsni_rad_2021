<?php 

    include_once "config.php";
    session_start();

    $term = $db->prepare("SELECT COUNT(*) FROM farmers WHERE email=:email");
    $term->bindValue('email', Request::post("email"));
    $term->execute();
    $end=$term->fetchAll();

    if($end[0][0]==="0") {
        include_once "index.php";
    }else{
        $_SESSION["email"]=Request::post("email");
        include_once "mainmenu.php";
    }