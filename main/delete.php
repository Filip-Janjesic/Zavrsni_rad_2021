<?php
include_once "config.php";

try {
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "DELETE FROM meeting WHERE id=$id";

  $db->exec($sql);

  echo "Meeting has been terminated";
} catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>