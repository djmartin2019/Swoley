<?php

require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/auth.php';

$email = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    login($user);
    header("Location: /dashboard.php");
    exit;
} else {
    echo "Invalid Credentials";
}
