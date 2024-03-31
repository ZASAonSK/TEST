<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?=$title ?></title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<nav>
  <h2 style="margin-top:0.5rem;">Edupage</h2>
  <ul>
    <?php
    $test=substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/'));
    switch ($test) {
        case "/index.php":
            $nastenka_active="style='pointer-events:none;cursor:default;opacity: 0.6;'";
            break;
        case "/users.php":
            $users_active="style='pointer-events:none;cursor:default;opacity: 0.6;'";
            break;
        case "/addusers.php":
            $add_users="style='pointer-events:none;cursor:default;opacity: 0.6;'";
            break;
    }
    ?>
    <li><a href='./' <?php if(isset($nastenka_active)) echo $nastenka_active ?>><button type="button"  class="btn btn-secondary btn-sm">Nástenka</button></a></li>
    <li><a href='./users.php' <?php if(isset($users_active)) echo $users_active ?>><button type="button"  class="btn btn-secondary btn-sm">Používatelia</button></a></li>
    <li><a href='./addusers.php' <?php if(isset($add_users)) echo $add_users ?>><button type="button"  class="btn btn-secondary btn-sm">Pridať používateľov</button></a></li>
    <li><a href='./logout.php'><button type="button"  class="btn btn-secondary btn-sm">Odhlásiť sa</button></a> </li>
    </ul>
</nav>
<body>