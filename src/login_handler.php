<?php

require 'src/db.php';
require 'src/auth.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    login($user);
    header("Location: /dashboard.php");
    exit;
} else {
    echo "Invalid Credentials";
}
