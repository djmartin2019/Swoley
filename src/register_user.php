<?php

require 'src/db.php';
require 'src/auth.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("
        INSERT INTO users (username, email, password_hash)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$username, $email, $password_hash]);

    // auto-login after register
    $user_id = $pdo->lastInsertId();

    login([
        'id' => $user_id,
        'email' => $email
    ]);

    header("Location: /dashboard.php");
    exit;
} catch (PDOException $e) {
    echo "Username or email already exists";
}
