<?php 
$hostName = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "login_register";
$conn =  mysqli_connect($hostName, $dbuser, $dbpassword, $dbname);
if (!$conn) {
    echo ("Something went wrong;");
}
?>