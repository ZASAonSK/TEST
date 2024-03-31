<?php
session_start();
$title="Používatelia";
include("./includes/pripojenie.php");
$sql="select * from users";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("./includes/navbar.php"); ?>
<h2 style='text-align: center;margin-top:15px;'><b>Používatelia</b></h2> <br>
<table style="width:75%;margin-left: auto;margin-right: auto;" >
    <tr >
    <th class="nazov">ID</th>
    <th class="nazov">Užívateľské meno</th>
    <th class="nazov">Meno</th>
    <th class="nazov">Priezvisko</th>
    <th class="nazov">E-mail</th>
    <th class="nazov">Rola</th>
    </tr>
<?php
$result = mysqli_query($conn, $sql);
if ($result==false){
  echo "Dačo sa pokazilo";
}
while($row = mysqli_fetch_array($result)) {
    $id=$row["id_user"];
    $login=$row["login"];
    $firstname=$row["firstname"];
    $lastname=$row["lastname"];
    $email=$row["email"];
    $role=$row["id_role"];
?>

    <tr>
    <th><?=$id?></th>
    <th><?=$login?></th>
    <th><?=$firstname?></th>
    <th><?=$lastname?></th>
    <th><?=$email?></th>
    <th><?=$role?></th>
    </tr>


<?php } ?> 
</table>
</body>
</html>