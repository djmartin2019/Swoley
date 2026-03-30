<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Swoley' ?></title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>

<?php include __DIR__ . '/components/navbar.php'; ?>

<main class="container">
    <?= $content ?>
</main>

<?php include __DIR__ . '/components/footer.php'; ?>

<script src="/js/navbar.js"></script>
</body>
</html>
