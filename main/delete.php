<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_GET['id'])) {
    $result = mysql_query("DELETE FROM `meeting` WHERE id='".mysql_real_escape_string($_GET['id']). "'");
    echo mysql_error();
    if($result)
        echo "succces";

} else {
    echo 'GET NOT SET';
}