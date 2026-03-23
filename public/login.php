<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swoley</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <?php include __DIR__ . '/../views/components/navbar.php'; ?>
    <div class="container">
    <h1>Login Page</h1>
        <div class="form__container">
        <form method="POST" action="/actions/login_handler.php">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div>
            <a href="register.php">Register</a>
            <a href="forgot_password.php">Forgot Password</a>
        </div>
        </div>
    </div>
<script src="/js/navbar.js"></script>
</body>
</html>
