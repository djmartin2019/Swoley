<?php require __DIR__ . '/../src/bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTC-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swoley - Forgot Password</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include __DIR__ '/../views/components/navbar.php'; ?>

    <div class="container">
        <h1>Forgot Password</h1>
        <div class="form__container">
        <form action="/actions/password_reset.php" method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />
            <div>
            <button type="submit">Send Password Reset</button>
        </form>
        </div>
    </div>
    <script src="/js/navbar.js"></script>
</body>
</html>
