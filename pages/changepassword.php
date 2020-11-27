<?php
    $errText = "";
    include '../utils/account.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["cancel"])) {
            header("location: ../index.php");
        } else {
            $password = trim($_POST["password"]);
            $passwordConfirm = trim($_POST["passwordConfirm"]);

            if(strlen($password) > 0) {
                if($password == $passwordConfirm) {
                    if(strlen($password) >= 6 && strlen($password) <= 16) {
                        session_start();
                        if(Account::ChangePassword($_SESSION["userdata"]["username"], $password)) {
                            header("location: ../logout.php");
                        } else {
                            $errText = "Valami hiba történt!";
                        }
                    } else {
                        $errText = "A jelszó 6-16 karakteres lehet!";
                    }
                } else {
                    $errText = "A két jelszó nem egyezik!";
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
    <title>Jelszó megváltoztatása</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Jelszó megváltoztatása</h1>
    <form action="changepassword.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputPassword1">Új jelszó</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Új jelszó">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Új jelszó megerősítése</label>
            <input type="password" name="passwordConfirm" class="form-control" id="exampleInputPassword2" aria-describedby="errorHelp" placeholder="Új jelszó megerősítése">
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="save" class="btn btn-primary">Mentés</button>
            <button type="submit" name="cancel" class="btn btn-secondary">Mégse</button>
        </div>
    </form>
</body>
</html>