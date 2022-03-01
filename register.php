<?php

    include_once "config.php";
    session_start();

    $term = $db->prepare("INSERT INTO farmers (opg, email, contactphone) VALUES
    (:opg, :email, :contactphone)");
    $term->bindValue('opg', Request::post("opg"));
    $term->bindValue('email', Request::post("email"));
    $term->bindValue('contactphone', Request::post("contactphone"));
    $term->execute();

    $_SESSION["email"]=Request::post("email");
    include_once "mainmenu.php";
?>