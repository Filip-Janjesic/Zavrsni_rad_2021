<?php  
include "../config.php";

if(isset($_GET["?id='.$id."])) 
{

    $result = mysql_query("DELETE FROM 'meeting' WHERE id='$id'");
    echo mysql_error();
    if($result)
        echo "succces";
}
else { echo "ERROR"; }

?>