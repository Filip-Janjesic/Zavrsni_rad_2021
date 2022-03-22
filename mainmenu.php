<?php

    include_once "config.php";
    session_start();

    $term = $db->prepare("SELECT COUNT(*) FROM farmers WHERE email=:email");
    $term->bindValue('email', Request::post("email"));
    $term->execute();
    $end=$term->fetchAll();
?>

<!doctype html>
<html lang="en">
    <head>
        <?php include_once "head.php"?>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <div class="bg-light border-right" id="sidebar-wrapper" style="background: #358CCE">
                <div class="sidebar-heading" > Farm meeting </div>
                <div class="list-group list-group-flush">
                    <a href="mainmenu.php?x=1" class="list-group-item list-group-item-action bg-light">Homepage</a>
                    <a href="mainmenu.php?x=2" class="list-group-item list-group-item-action bg-light">Arranged meetings</a>
                    <a href="mainmenu.php?x=3" class="list-group-item list-group-item-action bg-light">Arranged a new meeting</a>
                    <a href="mainmenu.php?x=4" class="list-group-item list-group-item-action bg-light">Settings</a>
                    <a href="mainmenu.php?x=5" class="list-group-item list-group-item-action bg-light">About us</a>
                    <a href="mainmenu.php?x=6" class="list-group-item list-group-item-action bg-light">Contact us</a>
                </div>
            </div>
            
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <button class="btn btn-primary" id="menu-toggle" style="background: #358CCE">Menu</button>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=$end[0][1]." ".$end[0][2]?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="mainmenu.php?x=7">My profile</a>
                                    <a class="dropdown-item" href="mainmenu.php?x=4">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                <?php
                        if (!isset($_GET['x']) || $_GET['x'] == 1) { include("main/homepage.php"); }
                        else if ($_GET['x'] == 2) { include("main/arrangedmeetings.php"); }
                        else if ($_GET['x'] == 3) { include("main/arrangednewmeeting.php"); }
                        else if ($_GET['x'] == 4) { include("main/settings.php"); }
                        else if ($_GET['x'] == 5) { include("main/aboutus.php"); }
                        else if ($_GET['x'] == 6) { include("main/contact.php"); }
                        else if ($_GET['x'] == 7) { include("main/adminprofile.php"); }
                    ?>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
    </body>
</html>