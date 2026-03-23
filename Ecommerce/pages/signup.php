<!-- <?php
include "../database/connection.php"
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ManG</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="signup-page">
    <!-- <div class="navbar">
        <div class="logo">
            <h1>ManG</h1>
        </div>
        <div class="options">
            <a href="../pages/signup.php">Home</a>
            <a href="#">About Us</a>                
            <a href="Dashboard.php?name=yonta&repeat=5">Greeting</a> 
            <a href="../pages/login.php" style="background: var(--primary); padding: 0.5rem 1rem; border-radius: 0.5rem; color: white;">Login</a>
        </div>
    </div> -->
    <div class="signup-container">
        <div class="signup-card">
            <h2>Create Account</h2>
            <form method="post" action="../controller/signupController.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
                <!-- <div class="form-group">
                    <label for="role">role</label>
                    <input type="text" name="role" id="role" placeholder="client" required>
                </div> -->
                <button type="submit" name="submit">Sign Up</button>
            </form>
            <a href="../pages/login.php" class="link">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>



<!-- termus -->
