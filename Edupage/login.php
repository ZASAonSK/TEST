<?php
session_start();
if(!isset($_SESSION['TS_register_uspesny'])){
  $_SESSION['TS_register_uspesny'] = False;
}
if ($_SESSION['TS_register_uspesny'] == True){
  echo "<center><h3> Registrácia úspešná môžeš sa prihásiť </h3></center>";
  $_SESSION['TS_register_uspesny'] = False;
}
if (isset( $_SESSION['id_user'])){
Header('Location: ./');
}
elseif (!isset( $_SESSION['id_user'])){

$user_l = (isset($_POST["username"])) ? $_POST["username"]: false ;
$user_p = (isset($_POST["password"])) ? $_POST["password"]: false ;
$submit = (isset($_POST['login_button'])) ? $_POST["login_button"] : false;

include("./includes/pripojenie.php");
 
$sql="select * from users where login='$user_l' or email='$user_l'";
$result = mysqli_query($conn, $sql);
if ($result==false){
  echo "Dačo sa pokazilo";
}
if (mysqli_num_rows($result)<1 && $submit){
  $zleudaje = "<h3 style='color:red; text-align: center;margin-bottom: 0.5em;margin-top: 0em;'>Zlé meno alebo email!</h3>";
}

while($row = mysqli_fetch_array($result)) {
    $database_id_user=$row["id_user"];
    $database_pass=$row["pass"];
    $database_firstname=$row["firstname"];
    $database_lastname=$row["lastname"];
    $database_id_role=$row["id_role"];
    $hashverify=password_verify($user_p, $database_pass);


      if ($hashverify && $submit){
        $_SESSION['id_user'] = $database_id_user;
        $_SESSION['firstname'] = htmlspecialchars($database_firstname);
        $_SESSION['lastname'] = htmlspecialchars($database_lastname);
        $_SESSION['id_role'] = htmlspecialchars($database_id_role);
        Header('Location: ./');
      }
      
      elseif ($submit==True){
        $zleudaje = "<h3 style='color:red; text-align: center;margin-bottom: 0.5em;margin-top: 0em;'>Zlé heslo!</h3>";
      } 
    }
    mysqli_close($conn);   
  ?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Prihlásiť sa</title>
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="wrapper">
    <form class="form-signin" action="./login.php" method=post>       
      <h2 class="form-signin-heading">Prihlás sa</h2>
      <?php if(isset($zleudaje)){echo $zleudaje;} ?>
      <input type="text" class="form-control" name="username" placeholder="Používateľské meno/email" autofocus="" required>
      <input type="password" class="form-control" name="password" placeholder="Heslo" required>     
      <input type="Submit" name="login_button" class="btn btn-lg btn-primary btn-block" value="Prihlásiť sa">
      <br>
      <!-- <a href="./register.php" style="margin:auto; text-align:center; display:block;">
      <button type="button" style="background-color:#e8e8e8;"class="btn btn-outline-secondary;">Registrácia</button></a>-->
    </form>
  </div>
  
</body>
</html>
<?php
}
?>

