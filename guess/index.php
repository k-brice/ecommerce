<?php

session_start(); 
if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = rand(1, 10);
    $_SESSION['attempts'] = 0;
}

$message = "Guess a number between 1 and 10";

if (isset($_POST['guess'])) {
    $num = (int)$_POST['guess']; 
    $_SESSION['attempts']++;

    if ($num === $_SESSION['secret']) {
        $message = "You win! It took you " . $_SESSION['attempts'] . " tries.";
        session_destroy();
    } elseif ($num < $_SESSION['secret']) {
        $message = "Too low. Try again.";
    } else {
        $message = "Too high. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="box">
    <h1>Guessing Game</h1>
    <p>Status: <?php echo $message; ?></p>

    <form method="POST">
        <input type="number" name="guess" required>
        <input type="submit" value="Submit Guess">
    </form>

    <br>
    <div class="restart">
    <a href="?reset=1">Restart Game</a>
    </div>
    <?php 
        if(isset($_GET['reset'])) { 
            session_destroy(); 
            header("Location: index.php"); 
        } 
       
    ?>
    </div>
</body>
</html>