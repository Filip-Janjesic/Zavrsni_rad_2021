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
    <h4>Not sure what meeting to attend?</h4>
    <p>Farm meeting the system automatically joins farmers into a group, farmers are selected by farm type, number of workers and preferred farming.</p>
    <h4>You don't have space?</h4>
    <p>Farm meeting in its system has more than 10 halls in the city with different dates, just choose what suits you best!</p>
    <hr>
    <h4>Farm meeting in numbers:</h4>
    <p>Farm meeting currently has <?=$farmernumber[0][0]?> system users.</p>
    <p>Farm meeting currently has <?=$meetingnumber[0][0]?> scheduled meetings in your system.</p>
</div>