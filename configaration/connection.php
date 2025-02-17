<?php


$sName = "localhost";
$uName = "root";
$pass = "";
$dbName = "inventory";

 $conn = new PDO("mysql:host=$sName; dbname=$dbName", $uName, $pass);

if(!$conn){
    die("Connection Failed:". mysql_connect_failed());
}

?>