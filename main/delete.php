<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../config.php');

$id = $_GET['id'];

$stmt = "DELETE FROM meeting WHERE id = :id";
$stmt->bindParam(':id', $id);

// Delete
if(isset($GET['btn_delete'])) { 
  $id = $_GET['id']; 
  $stmt->execute();
  header('Location: arrangednewmeeting.php');
}

?>
