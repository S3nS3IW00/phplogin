<?php
    $errText = "";
    include 'utils/account.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["login"])) {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            if(strlen($username) > 0 && strlen($password) > 0) {
                $userdata = Account::CheckLogin($username, $password);

                if(!is_null($userdata)) {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userdata"] = $userdata;
    
                    header("location: index.php");
                } else {
                    $errText = "Hibás felhasználónév vagy jelszó! Ha nincs fiókod, regisztrálj egyet az alábbi gombbal!";
                }
            } else {
                $errText = "Minden mező kitöltése kötelező!";
            }
        } else if(isset($_POST["register"])) {
            header("location: pages/register.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Bejelentkezés</h1>
    <form action="login.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputUsername1">Felhasználónév</label>
            <input type="username" name="username" class="form-control" id="exampleInputEmail1" placeholder="Felhasználónév">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszó</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" aria-describedby="errorHelp" placeholder="Jelszó">
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="login" class="btn btn-primary">Bejelentkezés</button>
            <button type="submit" name="register" class="btn btn-secondary">Regisztráció</button>
        </div>
    </form>
</body>
</html>