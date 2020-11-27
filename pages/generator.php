<?php
    $errText = "";
    $printText = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["back"])) {
            header('location: ../index.php');
        } else {
            $from = $_POST["from"];
            $to = $_POST["to"];
            $totable = isset($_POST["totable"]);

            if(strlen($from) > 0 && strlen($to) > 0) {
                if($totable) {
                    $printText .= "<table><tr><th>Páratlan</th><th>Páros</th></tr>";
                    for ($i = $from; $i <= $to; $i += 2) {
                        $printText .= "<tr><td>" . $i . "</td><td>" . ($i + 1) . "</td></tr>";
                    }
                    $printText .= "</table>";
                } else {
                    for($i = $from; $i <= $to; $i++) {
                        $printText .= $i;
                        if($i + 1 <= $to) $printText .= ", ";
                    }
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
    <title>Számgenerálás</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <h1>Számgenerálás</h1>
    <form action="generator.php" method="POST" style="max-width:500px;margin:20px;">
        <div class="form-group">
            <label for="exampleInputNumber1">Ettől</label>
            <input type="number" name="from" class="form-control" id="exampleInputNumber1" placeholder="Ettől">
        </div>
        <div class="form-group">
            <label for="exampleInputNumber2">Eddig</label>
            <input type="number" name="to" class="form-control" id="exampleInputNumber2" placeholder="Eddig">
        </div>
        <div class="form-group">
            <input type="checkbox" name="totable" class="form-check-input" id="exampleInputCheck1" aria-describedby="errorHelp">
            <label class="form-check-label" for="exampleInputCheck1">Táblázatba szervezés</label>
            <br>
            <small id="errorHelp" style="color:red;" class="form-text text-muted"><?php echo $errText ?></small>
        </div>
        <div class="container">
            <button type="submit" name="start" class="btn btn-primary">Kezdés</button>
            <button type="submit" name="back" class="btn btn-secondary">Vissza</button>
        </div>
    </form>

    <p><?php echo $printText; ?></p>
</body>
</html>