<?php
include "check.php";
$id=$_GET["id"];
mysql_query($link,"delete from meeting where id=$id");
?>