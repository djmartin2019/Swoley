<?php
require __DIR__ . '/../../src/bootstrap.php';
require_login();

$pdo = get_db();

$title = trim($_POST['title'] ?? '');
$date = $_POST['workout_date'] ?? date('Y-m-d');

if (!$title) {
    $title = "Workout";
}

// Insert workout
$stmt = $pdo->prepare("
    INSERT INTO workouts (user_id, title, workout_date)
    VALUES (?, ?, ?)
    RETURNING id
");

$stmt->execute([
    $_SESSION['user_id'],
    $title,
    $date
]);

$workoutId = $stmt->fetchColumn();

// Redirect to the new workout
header("Location: /workout.php?id=" . $workoutId);
exit;
