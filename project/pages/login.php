<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ManG</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="login-page">
    <div class="login-card">
        <h2>Welcome Back</h2>
        <form method="post" action="../controller/loginController.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <a href="../pages/signup.php" class="link">Don't have an account? Sign up</a>
    </div>
</body>
</html>