<?php
$dbservername = "marepalliharish73287.ipagemysql.com";
$dbusername = "mysqlroot_3";
$dbpassword = "Mysqlrootp@ss3";
$dbName = "spartanmarketplace272";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbName);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}
?>