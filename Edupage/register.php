<?php
session_start();
ini_set("display_errors", "0");
ini_set("display_startup_errors", "0");

if (isset( $_SESSION['id'])){
  Header('Location: ./');
}

$submit = (isset($_POST["register_button"])) ? $_POST["register_button"] : false;
if($submit){
$user_l = (isset($_POST["username"]) && preg_match('/^[a-zA-Z0-9]{1,25}$/', $_POST["username"])) ? $_POST["username"]: false ;
$user_p = (isset($_POST["password"]) && strlen($_POST["password"])>0 && strlen($_POST["password"])<=25) ? $_POST["password"]: false ;
$user_m = (isset($_POST["Meno"]) && strlen($_POST["Meno"])>0 && strlen($_POST["Meno"])<=25) ? ($_POST["Meno"]): false ;
$user_pr = (isset($_POST["Priezvisko"])  && strlen($_POST["Priezvisko"])>0 && strlen($_POST["Priezvisko"])<=25) ? ($_POST["Priezvisko"]): false ;
$user_e = (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ? $_POST["email"]: false ;
$sameuser=0;
$sameemail=0;
}
if($user_l==false && $submit){
  $zlylogin="class='chyba'";
}
if($user_p==false && $submit){
  $zleheslo="class='chyba'";
}
if($user_e==false && $submit){
  $zlyemail="<p class='chyba'>*Zlý Formát Emailu</p>";
}

include("./includes/pripojenie.php");

$hashpass=password_hash($user_p, PASSWORD_BCRYPT);
$sql="select * from users;";
$sql_write="INSERT INTO users (login,pass,firstname,lastname,email,role) VALUES ('$user_l','$hashpass','$user_m','$user_pr','$user_e','1')";
$result = mysqli_query($conn, $sql);
if ($result==false){
  echo "Dačo sa pokazilo";
}
while($row = mysqli_fetch_array($result)) {
if ($row["login"]==$user_l && $submit){
        $sameuser=$row["login"];
        $loginexist = "<h4 style='color:red; text-align: center;margin-bottom: 0.5em;margin-top: 0em;'>Toto použivateľské meno už existuje</h4>";
}
if ($row["email"]==$user_e && $submit){
      $sameemail=$row["email"];
      $emailexist= "<h4 style='color:red; text-align: center;margin-bottom: 0.5em;margin-top: 0em;'>Tento email už existuje</h4>";
} 
  }

    if($submit=True && strlen($user_l)>0 && strlen($user_p)>0 && strlen($user_m)>0 && strlen($user_pr)>0 && $sameuser!==$user_l && $sameemail!==$user_e) {
        if (mysqli_query($conn, $sql_write)){
          $_SESSION['TS_register_uspesny'] = True;
          Header('Location: ./login.php');
        }
        else echo"<h3 style='color:red; text-align: center;margin-bottom: 0.5em;margin-top: 0em;'>Niečo sa pokazilo</h3>";
        
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Registrácia</title>
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="wrapper">
    <form class="form-signin" action="./register.php" method=post>       
      <h2 class="form-signin-heading">Registrácia</h2>
      <?=$loginexist?>
      <?=$emailexist?>
      <input type="text" class="form-control" name="username" placeholder="Používateľské meno" pattern="[a-zA-Z0-9]{1,25}" value="<?=$_POST["username"]?>" maxlength="25" required>
      <p <?=$zlylogin?>>*Iba veľké, malé písmená a čisla (Max 25)</p>
      <input type="password" class="form-control" style='margin-bottom: 0px;' name="password" placeholder="Heslo" maxlength="25" required>
      <p <?=$zleheslo?>>*Max 25 znakov</p>
      <input type="text" class="form-control" style='margin-top: 20px;' name="Meno" placeholder="Meno"  value="<?=$_POST["Meno"]?>" maxlength="25" required> 
      <input type="text" class="form-control"  name="Priezvisko" placeholder="Priezvisko"  value="<?=$_POST["Priezvisko"]?>" maxlength="25" required>
      <input type="email" class="form-control" style='margin-top: 20px;' name="email" placeholder="Email" value="<?=$_POST["email"]?>" maxlength="50" required>
      <?=$zlyemail?> 
      <input type="Submit" name="register_button" class="btn btn-lg btn-primary btn-block" style='margin-top: 20px;' value="Zaregistrovať sa">
      <br>
      <a href='./' style="margin:auto; text-align:center; display:block;">
      <button type="button" style="background-color:#e8e8e8;" class="btn btn-outline-secondary">Späť na Login</button></a>
    </form>
  </div>
  
</body>
</html>