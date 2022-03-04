<?php

    include_once "head.php";
    include_once "config.php";

    $term = $db->prepare("SELECT * FROM farmType");
    $term->execute();
    $end=$term->fetchAll();

    if(!empty($_POST)) {
        $term = $db->prepare("INSERT INTO meeting (farmType, meetingStart, meetingLocation, reason) VALUES
        (:farmType, :meetingStart, :meetingLocation, :reason)");
        $term->bindValue('meetingStart', Request::post("meetingStart"));
        $term->bindValue('meetingLocation', Request::post("meetingLocation"));
        $term->bindValue('reason', Request::post("reason"));
        $term->bindValue('farmType', 1);
        $term->execute();
    }

    $term = $db->prepare("SELECT COUNT(*) FROM meeting");
    $term->execute();
    $number=$term->fetchAll();

    $term = $db->prepare("SELECT * FROM meeting;");
    $term->execute();
    $list=$term->fetchAll();
?>
