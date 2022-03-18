<?php  
include "../config.php";

if(isset($_GET["id"])) 
{
    $result = mysql_query("DELETE FROM 'meeting' WHERE id=".$_GET['id']);
    
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