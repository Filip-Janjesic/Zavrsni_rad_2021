<?php

    include_once "head.php";
    include_once "config.php";

    $term = $db->prepare("SELECT * FROM farmers WHERE email=:email");
    $term->bindValue('email', $_SESSION["email"]);
    $term->execute();
    $end=$term->fetchAll();

    if(!empty($_POST)) {
        $term = $db->prepare("UPDATE farmers SET opg=:opg, contactphone=:contactphone where id=:id");
        $term->bindValue('opg', Request::post("opg"));
        $term->bindValue('contactphone', Request::post("contactphone"));
        $term->bindValue('id', $end[0][0]);
        $term->execute();
    }
?>

<div class="jumbotron jumbotron-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h1">
                    <small>Settings</small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class=" col-lg-4 col-sm-12"></div>
    <div class=" col-lg-4 col-sm-12">
        <h4 style="padding-left: 2cm; padding-bottom: 1cm"> Change data </h4>
        <form action="" method="post" name="update">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="opg" placeholder="<?=$end[0][1]?>" value="<?=$end[0][1]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="surname" placeholder="<?=$end[0][2]?>" value="<?=$end[0][2]?>">
            <input class="form-control" style="text-align: center;margin-bottom: 1cm" type="text" name="contactphone" placeholder="<?=$end[0][5]?>" value="<?=$end[0][5]?>">
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Save changes </button>
        </form>
    </div>
</div>