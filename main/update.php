<?php

    include_once "../head.php";
    include_once "../config.php";

    $term = $db->prepare("SELECT * FROM meeting WHERE id=:id");
    $term->bindValue('id', $_SESSION["id"]);
    $term->execute();
    $end=$term->fetchAll();

    if(!empty($_POST)) {
        $term = $db->prepare("UPDATE meeting SET meetingStart=:meetingStart, meetingLocation=:meetingLocation, reason=:reason where id=:id");
        $term->bindValue('meetingStart', Request::post("meetingStart"));
        $term->bindValue('meetingLocation', Request::post("meetingLocation"));
        $term->bindValue('reason', Request::post("reason"));
        $term->bindValue('id', $_GET["id"]);
        $term->execute();
    }
?>

<div class="container">
    <div class="row">
    <div class=" col-lg-4 col-sm-12"></div>
    <div class=" col-lg-4 col-sm-12">
        <h4 style="padding: 30px 50px 20px;"> Update meeting </h4>
        <form action="" method="post" name="update">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="datetime-local" name="meetingStart" placeholder="Select a date">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingLocation" placeholder="Enter the location">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="text" name="reason" placeholder="Enter the reason">
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Save changes </button>
        </form>
    </div>
</div>
