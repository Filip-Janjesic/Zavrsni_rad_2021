<?php

include_once "head.php";
include_once "config.php";

$term = $db->prepare("SELECT COUNT(*) FROM meeting");
$term->execute();
$meetingnumber=$term->fetchAll();

$term = $db->prepare("SELECT COUNT(*) FROM farmers");
$term->execute();
$farmernumber=$term->fetchAll();
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small> Farm meeting</small>
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h3>Not sure which meeting to attend?</h3>
    <p><b>Farm meeting system automatically joins farmers into a group, farmers are selected by farm type, number of workers and preferred farming.</b></p>
    <hr>
    <br>
    <h3>You don't have space?</h3>
    <p><b>Farm meeting can be arranged anywhere in the city with different dates, just choose what suits you best!</b></p>
    <hr>
    <br>
    <h3>Farm meeting in numbers:</h3>
    <p><b>Farm meeting currently has <?=$farmernumber[0][0]?> system users.</b></p>
    <p><b>Farm meeting currently has <?=$meetingnumber[0][0]?> scheduled meetings in your system.</b></p>
    <hr>
</div>