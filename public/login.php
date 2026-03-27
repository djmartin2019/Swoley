<?php require __DIR__ . '/../src/bootstrap.php';

$title = "Login";

ob_start();
?>
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

<?php
$content = ob_get_clean();
include __DIR__ . '/../views/layout.php';
