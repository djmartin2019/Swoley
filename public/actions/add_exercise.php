<?php
require __DIR__ . '/../../src/bootstrap.php';
require_login();

$pdo = get_db();

// Validate input
$workoutId = $_POST['workout_id'] ?? null;
$name = trim($_POST['name'] ?? '');

if (!$workoutId || !$name) {
    die("Invalid input.");
}

// Verify workout belongs to user
$stmt = $pdo->prepare("
    SELECT id FROM workouts
    WHERE id = ? AND user_id = ?
    ");
$stmt->execute([$workoutId, $_SESSION['user_id']]);

if (!$stmt->fetch()) {
    die("Unauthorized.");
}

// Insert exercise
$stmt = $pdo->prepare("
    INSERT INTO exercises (workout_id, name)
    VALUES (?, ?)
    ");
$stmt->execute([$workoutId, $name]);

// Redirect back
header("Location: /workout.php?id=" . $workoutId);
exit;
