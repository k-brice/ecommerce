<?php
function printe($name= "player"){
    echo "this is me $name";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    printe();
    echo "<br>";
    printe("yonta");

    echo "<br>";
    echo date("d-m-y");

    $num=rand(1,20);
    echo "<br> $num";
    ?>
    <!--ass: do the guess game -->
</body>
</html>