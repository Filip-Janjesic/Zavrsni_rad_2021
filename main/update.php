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
        $term->bindValue('id', $end[0][0]);
        $term->execute();
    }
?>

<div class="container">
    <div class="row">
    <div class=" col-lg-4 col-sm-12"></div>
    <div class=" col-lg-4 col-sm-12">
        <h4 style="padding: 30px 50px 20px;"> Update meeting </h4>
        <form action="" method="post" name="update">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingStart" placeholder="<?=$end[0][1]?>" value="<?=$end[0][1]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingLocation" placeholder="<?=$end[0][2]?>" value="<?=$end[0][2]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="reason" placeholder="<?=$end[0][5]?>" value="<?=$end[0][5]?>">
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Save changes </button>
        </form>
    </div>
</div>