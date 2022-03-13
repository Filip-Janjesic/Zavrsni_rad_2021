<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once "../config.php";

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $id=(int)
  $sql = "DELETE FROM meeting WHERE id =".$id;
  $db = exec($sql);
  echo "Record deleted successfully";

$conn = null;
?>