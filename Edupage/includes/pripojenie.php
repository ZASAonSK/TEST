<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name="edupage";

$conn = mysqli_connect($servername, $username,$password,$database_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error(). "<br>Skúste znovu neskôr");
  
}
?>
