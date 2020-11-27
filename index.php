<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Főoldal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Üdvözöllek, <?php echo $_SESSION["userdata"]["username"] ?>!</h1>

    <br>

    <div class="list-group">
        <a href="pages/changeusername.php" class="list-group-item list-group-item-action">Felhasználónév megváltoztatása</a>
        <a href="pages/changepassword.php" class="list-group-item list-group-item-action">Jelszó megváltoztatása</a>
        <a href="pages/changeuserdata.php" class="list-group-item list-group-item-action">Felhasználói adatok megváltoztatása</a>
        <a href="pages/generator.php" class="list-group-item list-group-item-action">Számgenerálás</a>
        <a href="logout.php" class="list-group-item list-group-item-action">Kijelentkezés</a>
    </div>
</body>
</html>