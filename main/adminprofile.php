<?php 

include_once "head.php";
include_once "config.php";

    $term = $db->prepare("SELECT * FROM farmers");
    $term->execute();
    $end=$term->fetchAll();
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small>Admin profile</small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-3">
            <img src="pictures/profilepic.png" alt="" height="370px" width="300px">
        </div>
        <div class="col-1"></div>
        <div class="col-6" style="padding-top: 2cm">
            <p>OPG: <?=$end[0][1]?></p>
            <p>email: <?=$end[0][2]?></p>
            <p>phone number: <?=$end[0][3]?></p>
        </div>
    </div>
</div>
