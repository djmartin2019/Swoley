<?php
require __DIR__ . '/../src/auth.php';
require_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swoley - Your Dashboard</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <?php include __DIR__ . '/../views/components/navbar.php'; ?>
    <div class="container">
        <h1>Dashboard</h1>
    </div>
    <script src="/js/navbar.js"></script>
</body>
</html>
