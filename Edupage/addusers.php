<?php
session_start();
$title="Pridať používateľa";
include("./includes/pripojenie.php");
$sql="select * from users";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("./includes/navbar.php"); ?>
<h2 style='text-align: center;margin-top:15px;'><b>Pridať Používateľa</b></h2> <br>