<?php

    error_reporting(0);
    $user = "afrodita_Filip-J"; // Mysql user
    $pass = "t84durft1994"; // Mysql pass
    $db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, $pass);

    try{
        $db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, $pass);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }


?>
