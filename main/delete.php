<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = "afrodita_Filip-J"; // Mysql user
$pass = "t84durft1994"; // Mysql pass
$db = new PDO("mysql:dbname=afrodita_Zavrsni_rad_2021;host=localhost;charset=utf8", $user, $pass);

class Request
{
public static function pathInfo()
{
    if (isset($_SERVER['PATH_INFO'])) 
    {
        return $_SERVER['PATH_INFO'];
    } elseif (isset($_SERVER['REDIRECT_PATH_INFO'])) 
    {
        return $_SERVER['REDIRECT_PATH_INFO'];
    } else {
        return '';
    }
}
public static function post($key, $default = '')
{
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
}

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