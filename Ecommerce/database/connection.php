<?php
$user_name = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') ?: "";
$host = getenv('DB_HOST') ?: "localhost";
$dbname = getenv('DB_NAME') ?: "Ecommerce";
$conn = mysqli_connect($host, $user_name, $password, $dbname);
// if(!$conn){
//     die("connection failed");
// }else{
//     echo "connected successfully";
// }
?>