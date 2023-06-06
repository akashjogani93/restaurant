<?php


$host = "localhost";
$dbuser = "root";
$dbpass = "";

$db = "resto";
//$db ="urban1";
$conn = mysqli_connect($host,$dbuser,$dbpass,$db) or die("Cannot Connect to Database Server");
$d = mysqli_select_db($conn, $db) or die("Database does not exist");
?>