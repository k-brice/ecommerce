<?php
session_start();
include "../database/connection.php";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Use prepared statements to prevent SQL injection if possible, 
    // or at least escape the strings depending on the course requirement.
    // For simplicity following existing pattern:
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sqlSelect = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sqlSelect);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Login success
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"]; // Store role in session
        
        // Redirect to landing page
        header("Location: ../pages/landing.php");
        exit();
    } else {
        // Login failed
        echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
        echo "<h2>Login Failed</h2>";
        echo "<p>Invalid email or password. Please make sure you are registered in the database.</p>";
        echo "<a href='../pages/login.php' style='display: inline-block; padding: 10px 20px; background-color: #e24a4a; color: white; text-decoration: none; border-radius: 5px;'>Try Again</a>";
        echo "</div>";
    }
} else {
    header("Location: ../pages/login.php");
    exit();
}
?>
