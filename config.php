<?php

$siteurl="http://localhost/cedcosstask/phpmysql/phpmysql2/";

$hostname = "localhost";
$username = "root";
$password = "";
$database="onlinetest";


$conn = new mysqli($hostname, $username, $password, $database);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

