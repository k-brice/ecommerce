<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
      $age = 10;

     /* if($age > 10){
        echo"you are already admited to vote";
      }else if($age < 10  && $age >15){
        echo "you cannot vote";
      }else if($age > 20 && $age < 15) {
        echo "you can vote";
      }else{
        echo "you are still very small";
      }*/
       switch ($age){
        case 10: 
            echo "i am 10 year old";
        break;
         case 20: 
            echo "i am 20 year old";
        break;
         case 30: 
            echo "i am 30 year old";
        break;
         case 40: 
            echo "i am 40 year old";
        break;
        default: 
        echo "I am too small";
       }

    ?>
</head>
<body>
    
</body>
</html>