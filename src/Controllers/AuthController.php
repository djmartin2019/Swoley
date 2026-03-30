<?php

require_once __DIR__ . '/../Core/BaseController.php';

class AuthController extends BaseController
{
    public function showLogin()
    {
        $this->render('login', ['title' => 'Login']);
    }

    public function showRegister()
    {
        $this->render('register', ['title' => 'Register']);
    }

    public function login()
    {
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

    public function register()
    {
        $pdo = get_db();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            die("Username, email, and password are required");
            exit;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("
                INSERT INTO users (username, email, firstName, lastName, password_hash)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([$username, $email, $firstName, $lastName, $password_hash]);

            // auto-login after register
            $user_id = $pdo->lastInsertId();

            login([
                'id' => $user_id,
                'email' => $email
            ]);

            header("Location: /dashboard");
            exit;
        } catch (PDOException $e) {
            echo "Username or email already exists";
        }
    }

    public function logout()
    {
        logout();
        header("Location: /");
        exit;
    }
}
