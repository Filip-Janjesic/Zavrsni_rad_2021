<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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