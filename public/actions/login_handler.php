<?php

require __DIR__ . '/../../src/db.php';
require __DIR__ . '/../../src/auth.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    die("All fields required");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    login($user);
    header("Location: /dashboard.php");
    exit;
} else {
    echo "Invalid Credentials";
}
