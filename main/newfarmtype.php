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

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small>New farm type</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class=" col-lg-4 col-sm-12"></div>
        <div class=" col-lg-4 col-sm-12">
            <h4 style="padding-left: 2cm; padding-bottom: 1cm">Create new farm type</h4>
            <form action="" method="post" name="update">
                <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="datetime-local" name="matchStart" placeholder="Odaberi datum">
                <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="matchLocation" placeholder="Upiši lokaciju">
                <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="matchPrice" placeholder="Upiši cijenu">
                <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i>Spremi promjene</button>
            </form>
        </div>
    </div>