<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$user = "afrodita_Filip-J"; // Mysql user
$pass = "t84durft1994"; // Mysql pass
$db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, 't84durft1994');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "DELETE FROM meeting WHERE id=:id";

  echo "Record deleted successfully";

$conn = null;
?>