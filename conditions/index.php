<?php
$age = 20;
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
    /*if($age<10){
        echo" you are too young";
    }else if($age>10 && $age<15){
        echo "younger";
    }else{
        echo "good age";
    }*/
    switch($age){
        case 5: 
            echo "you are too young";
        break;
        case 10:
            echo "almost there";
        break;
        case 2:
            echo "you are good to go";
        break;
        default:
            echo "no age";
        break;
    }
    ?>
</body>
</html>