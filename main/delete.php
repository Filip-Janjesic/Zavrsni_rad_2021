<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../config.php";

$get_id=$_GET['id'];

$sql = "DELETE FROM meeting WHERE id = '$get_id'";

$conn->exec($sql);
header('location:arrangednewmeeting.php');
?>