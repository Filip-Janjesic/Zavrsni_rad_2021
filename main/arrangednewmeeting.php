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
                    <small>New meetings</small>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class=" col-lg-4 col-sm-12"></div>
        <div class=" col-lg-4 col-sm-12">
            <h4 style="padding-left: 2cm; padding-bottom: 1cm">Arrange new meetings</h4>
            <form action="" method="post" name="update">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="datetime-local" name="meetingStart" placeholder="Select a date">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="text" name="meetingLocation" placeholder="Enter the location">
                <input class="form-control mb-2" style="text-align: center;margin-bottom: 1cm" type="text" name="reason" placeholder="Enter the reason">
                <button class="btn btn-success btn-block mb-5" type="submit"><i class="fas fa-sign-in-alt"></i>Save changes</button>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Order</th>
                <th scope="col">Start date</th>
                <th scope="col">Location</th>
                <th scope="col">Reason</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i<$number[0][0]; $i++):?>
            <tr>
                <th scope="row"><?=$list[$i][0]?></th>
                <td><?=$list[$i][2]?></td>
                <td><?=$list[$i][3]?></td>
                <td><?=$list[$i][4]?></td>
                <td><?=$list[$i][5]?> <button class ="btn btn-primary" type="submit"><a href="main/update.php?id=<?$list[$i][2]->$id?>" class="text-light">Update</a></button></td>
                <td><?=$list[$i][6]?> <button class ="btn btn-danger" type="submit"><a href="main/delete.php?id=<?$list[$i][2]->$id?>" class="text-light">Delete</a></button></td> 
            </tr>
            <?php endfor;?>
        </tbody>
    </table>


