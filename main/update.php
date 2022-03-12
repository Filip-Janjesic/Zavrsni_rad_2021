<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    $term = $db->prepare("SELECT * FROM meeting WHERE id=:id");
    $term->bindValue('id', $_SESSION["id"]);
    $term->execute();
    $end=$term->fetchAll();

    if(!empty($_POST)) {
        $term = $db->prepare("UPDATE meeting SET farmType=:farmType, meetingStart=:meetingStart , meetingLocation=:meetingLocation, reason=:reason where id=:id");
        $term->bindValue('farmType', Request::post("farmType"));
        $term->bindValue('meetingStart', Request::post("meetingStart"));
        $term->bindValue('meetingLocation', Request::post("meetingLocation"));
        $term->bindValue('reason', Request::post("reason"));
        $term->bindValue('id', $end[0][0]);
        $term->execute();
    }
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small>Edit meeting</small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class=" col-lg-4 col-sm-12"></div>
    <div class=" col-lg-4 col-sm-12">
        <h4 style="padding-left: 2cm; padding-bottom: 1cm"> Update </h4>
        <form action="" method="post" name="update">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="farmType" placeholder="<?=$end[0][0]?>" value="<?=$end[0][0]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingStart" placeholder="<?=$end[0][2]?>" value="<?=$end[0][0]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingLocation" placeholder="<?=$end[0][0]?>" value="<?=$end[0][0]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="reason" placeholder="<?=$end[0][0]?>" value="<?=$end[0][0]?>">
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Save changes </button>
        </form>
    </div>
</div>