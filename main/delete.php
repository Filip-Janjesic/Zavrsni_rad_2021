<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "../config.php";



try {
    $db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, $pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM meeting WHERE id='" . $_GET["id"] . "'";

    $db->exec($sql);
    echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "
" . $e->getMessage();
    }

$db = null;
?>