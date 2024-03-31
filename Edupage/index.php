<?php
session_start();
if (!isset( $_SESSION['id_user'])){
    Header('Location: ./login.php');
}
$title="Nástenka";
$id_role=$_SESSION['id_role'];
include("./includes/pripojenie.php");
$sql="select role from role where id_role='$id_role'";
$result = mysqli_query($conn, $sql);
if ($result==false){
  echo "Dačo sa pokazilo";
}
else $rolename = mysqli_fetch_array($result);
echo $rolename['role'];

?>
<html lang="en" >
<?php include("./includes/navbar.php"); ?>


<h2 style='text-align: center;margin-top:15px;'><b>Prihlásený užívateľ</b></h2> <br>
<h3 style='text-align: center;margin-bottom: 0em;margin-top: 0em;'>
Meno a Priezvisko: <b> <?=$_SESSION['firstname']?> <?=$_SESSION['lastname']?></b><br>

</h3>
     
  
  
</body>
</html>  

