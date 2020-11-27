<?php
    session_start();
    $errText = "";
    include '../utils/account.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["cancel"])) {
            header("location: ../index.php");
        } else {
            $username = trim($_POST["username"]);

            if(strlen($username) > 0) {
                if(strlen($username) <= 16) {
                    if(Account::ChangeUsername($_SESSION["userdata"]["username"], $username)) {
                        $_SESSION["userdata"]["username"] = $username;
                        header("location: ../index.php");
                    } else {
                        $errText = "Ez a felhasználónév már foglalt!";
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
    <title>Felhasználónév megváltoztatása</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Felhasználónév megváltoztatása</h1>
    <form action="changeusername.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputUsername1">Új felhasználónév</label>
            <input type="username" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="errorHelp" placeholder="Új felhasználónév" value="<?php echo $_SESSION["userdata"]["username"] ?>">
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="save" class="btn btn-primary">Mentés</button>
            <button type="submit" name="cancel" class="btn btn-secondary">Mégse</button>
        </div>
    </form>
</body>
</html>