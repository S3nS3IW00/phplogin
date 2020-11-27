<?php
    $errText = "";
    include 'utils/account.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["login"])) {
            header("location: login.php");
        } else {
            $email = $_POST["email"];
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $passwordConfirm = trim($_POST["passwordConfirm"]);

            if(strlen($email) > 0 && strlen($username) > 0 && strlen($password) > 0) {
                if(strlen($username) <= 16) {
                    if($password == $passwordConfirm) {
                        if(strlen($password) >= 6 && strlen($password) <= 16) {
                            if(Account::Register($email, $username, $password)) {
                                header("location: login.php");
                            } else {
                                $errText = "Ez a felhasználónév már foglalt!";
                            }
                        } else {
                            $errText = "A jelszó 6-16 karakteres lehet!";
                        }
                    } else {
                        $errText = "A két jelszó nem egyezik!";
                    }
                } else {
                    $errText = "A felhasználónév maximum 16 karakteres lehet!";
                }
            } else {
                $errText = "Minden mező kitöltése kötelező!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Regisztráció</h1>
    <form action="register.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputUsername1">Felhasználónév</label>
            <input type="username" name="username" class="form-control" id="exampleInputEmail1" placeholder="Felhasználónév">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszó</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Jelszó">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Jelszó megerősítése</label>
            <input type="password" name="passwordConfirm" class="form-control" id="exampleInputPassword2" aria-describedby="errorHelp" placeholder="Jelszó megerősítése">
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="login" class="btn btn-primary">Bejelentkezés</button>
            <button type="submit" name="register" class="btn btn-secondary">Regisztráció</button>
        </div>
    </form>
</body>
</html>