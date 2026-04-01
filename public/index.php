<?php

require __DIR__ . '/../src/Core/Database.php';
require __DIR__ . '/../src/Core/Model.php';
require __DIR__ . '/../src/Models/User.php';
require __DIR__ . '/../src/Models/Workout.php';
require __DIR__ . '/../src/Models/Exercise.php';
require __DIR__ . '/../src/Models/Set.php';
require __DIR__ . '/../src/Core/BaseController.php';

require __DIR__ . '/../src/bootstrap.php';

require __DIR__ . '/../src/Controllers/HomeController.php';
require __DIR__ . '/../src/Controllers/AuthController.php';
require __DIR__ . '/../src/Controllers/DashboardController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Home
if ($uri === '/' && $method === 'GET') {
    (new HomeController())->index();
    exit;
}

// About
if ($uri === '/about' && $method === 'GET') {
    (new HomeController())->about();
    exit;
}

// Contact
if ($uri === '/contact' && $method === 'GET') {
    (new HomeController())->contact();
    exit;
}

// Login (GET)
if ($uri === '/login' && $method === 'GET') {
    (new AuthController())->showLogin();
    exit;
}

// Login (POST)
if ($uri === '/login' && $method === 'POST') {
    (new AuthController())->login();
    exit;
}

// Logout (POST)
if ($uri === '/logout' && $method === 'POST') {
    (new AuthController())->logout();
    exit;
}

// Register (GET)
if ($uri === '/register' && $method === 'GET') {
    (new AuthController())->showRegister();
    exit;
}

// Register (POST)
if ($uri === '/register' && $method === 'POST') {
    (new AuthController())->register();
    exit;
}

// Forgot Password (GET)
if ($uri === '/forgot-password' && $method === 'GET') {
    (new AuthController())->showForgotPassword();
    exit;
}

// Forgot Password (POST)
if ($uri === '/forgot-password' && $method === 'POST') {
    (new AuthController())->forgotPassword();
    exit;
}

// Dashboard
if ($uri === '/dashboard' && $method === 'GET') {
    (new DashboardController())->index();
    exit;
}

// Fallback
http_response_code(404);
echo "404 Not Found";
