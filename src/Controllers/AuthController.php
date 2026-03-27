<?php

class AuthController
{
    public function showLogin()
    {
        global $loggedIn;

        $title = "Login";

        ob_start();
        require __DIR__ . '/../Views/login.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout.php';
    }

    public function login()
    {
        global $loggedIn;

        $pdo = get_db();

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
            header("Location: /dashboard");
            exit;
        } else {
            echo "Invalid Credentials";
        }
    }
}
