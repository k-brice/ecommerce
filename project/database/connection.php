<?php
$user_name= "root";
$password= "";
$host = "localhost";
$dbname ="BA2A";
$conn = mysqli_connect($host, $user_name, $password, $dbname);
if(!$conn){
    die("connection failed");
}else{
    echo "connected successfull";
}
?>