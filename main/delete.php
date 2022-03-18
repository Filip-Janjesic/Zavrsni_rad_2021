<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "../config.php";

if(isset($_GET["id"])) 
{
    $result = mysql_query("DELETE FROM 'meeting' WHERE id=", intval($_GET['id']));
    
    if(!$result){
      echo mysql_error();
    }else{
      echo "succces";
    }
}
else { 
  echo "ID is not valid."; 
}

?>