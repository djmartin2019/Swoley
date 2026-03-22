<?php

function start_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function login($user) {
    start_sessions();

    // Regenerate session ID to prevent fixation
    session_regenerate_id(true)

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
}

function logout() {
    start_session();

    $_SESSION = [];

    session_destory();
}

function is_logged_in() {
    start_session();
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: /login.php");
        exit;
    }
}

function current_user_id() {
    start_session();
    return $_SESSION['user_id'] ?? null;
}
