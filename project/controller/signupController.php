<?php
session_start();
include "../database/connection.php";
 if(isset($_POST["submit"])){
     $name=$_POST["name"];
     $email=$_POST["email"];
     $class=$_POST["class"];
     $password=$_POST["password"];
    //  $role=$_POST["role"];
 }
 $sqlCreateTable="CREATE TABLE IF NOT EXISTs user(
     id int primary key not null auto_increment,
     name varchar(50) not null,
     email varchar(50) not null,
     class varchar(50) not null,
     password varchar(50) not null
    --  ,
    --  role varchar(50) not null 
    )";
if(mysqli_query($conn, $sqlCreateTable)){
    echo " <br>table user created";
}else{
    echo "failed to create";
}

if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $class=$_POST["class"];
    $password=$_POST["password"];
    // $role = $_POST["role"];

    $sqlInsert = "INSERT INTO user (name, email, class, password) VALUES ('$name', '$email', '$class', '$password')";
    
    if(mysqli_query($conn, $sqlInsert)){
        echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
        echo "<h2>User added successfully!</h2>";
        echo "<p>You have been added to the database.</p>";
        echo "<a href='../pages/login.php' style='display: inline-block; padding: 10px 20px; background-color: var(--primary, #4a90e2); color: white; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
        echo "</div>";
    } else {
        echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
        echo "<h2>Failed to add user!</h2>";
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
        echo "<a href='../pages/signup.php' style='display: inline-block; padding: 10px 20px; background-color: #e24a4a; color: white; text-decoration: none; border-radius: 5px;'>Try Again</a>";
        echo "</div>";
    }
}
?>