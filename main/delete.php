<?php
include_once "config.php";

try {
  $db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, $pass);
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "DELETE FROM meeting WHERE id=$id";

  $db->exec($sql);

  echo "Meeting has been terminated";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>