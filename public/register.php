<?php require __DIR__ . '/../src/bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up For Swoley</title>
    <link rel="stylesheet"  href="/styles/style.css">
</head>
<body>
    <?php include __DIR__ . '/../views/components/navbar.php'; ?>
    <div class="container">
    <h1>Register</h1>
        <div class="form__container">
        <form action="/actions/register_user.php" method="post">
            <div>
                <h3>Your Information</h3>
                <div>
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div>
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div>
                <h3>Account info</h3>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <button type="submit">Create Account</button>
        </form>
        </div>
    </div>
<script src="/js/navbar.js"></script>
</body>
</html>
