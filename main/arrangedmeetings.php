<?php
    include_once "head.php";
    include_once "config.php";

    $term = $db->prepare("SELECT * FROM farmers WHERE email=:email");
    $term->bindValue('email', $_SESSION["email"]);
    $term->execute();
    $end=$term->fetchAll();
    $farmersID=$end[0][0];

    $term = $db->prepare("SELECT COUNT(*) FROM farmers_meeting WHERE farmers=:farmers");
    $term->bindValue('farmers',$farmersID);
    $term->execute();
    $count=$term->fetchAll();

    $term = $db->prepare("SELECT farmType FROM meeting WHERE id=:id");
    $term->bindValue('id',$count[0][0]);
    $term->execute();
    $mostorganized=$term->fetchAll();

    $term = $db->prepare("SELECT nname FROM farmType WHERE id=:id");
    $term->bindValue('id',$mostorganized[0][0]);
    $term->execute();
    $nname=$term->fetchAll();
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small>My meetings</small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h4>So far you are organized <?=$count[0][0]?> meetings.</h4>
    <h4>Your most frequently organized meeting is <?=$nname[0][0]?></h4>
</div>