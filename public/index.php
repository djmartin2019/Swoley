<?php

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

// Dashboard
if ($uri === '/dashboard' && $method === 'GET') {
    (new DashboardController())->index();
    exit;
}

// Fallback
http_response_code(404);
echo "404 Not Found";
