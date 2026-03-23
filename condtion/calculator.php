<?php 
    $calculte  = $_POST['operation'];
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    if($calculte == "add"){
        $result = $num1 + $num2;
        echo "The result is: " . $result;
    }else if($calculte == "subtract"){
        $result = $num1 - $num2;
        echo "The result is: " . $result;
    }else if($calculte == "multiply"){
        $result = $num1 * $num2;
        echo "The result is: " . $result;
    }else if($calculte == "divide"){
        if($num2 != 0){
            $result = $num1 / $num2;
            echo "The result is: " . $result;
        } else {
            echo "Error: Division by zero is not allowed.";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="calculator.php" method="post">
        <h2 style="text-align: center;">Calculator</h2>
        <input type="number" name="num1" placeholder="Enter first number">
        <input type="number" name="num2" placeholder="Enter second number">
        <select name="operation" style="background-color: blue;">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="divide">Divide</option>
        </select>
        <button style="background-color: green;" type="submit">Calculate</button>
    </form>
</body>
</html>
