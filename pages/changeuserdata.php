<?php
    session_start();
    $errText = "";
    include '../utils/account.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["back"])) {
            header("location: ../index.php");
        } else {
            $email = $_POST["email"];
            $age = $_POST["age"];
            $fullname = trim($_POST["fullname"]);

            if(strlen($email) > 0 && strlen($age) > 0 && strlen($fullname) > 0) {
                if(strlen($fullname) <= 50) {
                    $userdata = $_SESSION["userdata"];

                    $done = true;
                    if($userdata["email"] != $email) {
                        if(Account::ChangeUserdata($userdata["username"], "email", $email)) {
                            $_SESSION["userdata"]["email"] = $email;
                        } else {
                            $errText = "Valami hiba történt!";
                            $done = false;
                        }
                    }
                    if($userdata["age"] != $age) {
                        if(Account::ChangeUserdata($userdata["username"], "age", $age)) {
                            $_SESSION["userdata"]["age"] = $age;
                        } else {
                            $errText = "Valami hiba történt!";
                            $done = false;
                        }
                    }
                    if($userdata["name"] != $fullname) {
                        if(Account::ChangeUserdata($userdata["username"], "name", $fullname)) {
                            $_SESSION["userdata"]["name"] = $fullname;
                        } else {
                            $errText = "Valami hiba történt!";
                            $done = false;
                        }
                    }

                    if($done) {
                        header("location: ../index.php");
                    }
                } else {
                    $errText = "A név maximum 50 karakteres lehet!";
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
    <title>Felhasználói adatok megváltoztatása</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Felhasználói adatok megváltoztatása</h1>
    <form action="changeuserdata.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $_SESSION["userdata"]["email"] ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputNumber1">Életkor</label>
            <input type="number" name="age" class="form-control" id="exampleInputNumber1" placeholder="Életkor" value="<?php echo $_SESSION["userdata"]["age"] ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputFullname1">Teljes név</label>
            <input type="text" name="fullname" class="form-control" id="exampleInputFullname1" aria-describedby="errorHelp" placeholder="Teljes név" value="<?php echo $_SESSION["userdata"]["name"] ?>">
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="save" class="btn btn-primary">Mentés</button>
            <button type="submit" name="back" class="btn btn-secondary">Vissza</button>
        </div>
    </form>
</body>
</html>