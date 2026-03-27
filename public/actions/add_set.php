<?php
require __DIR__ . '/../../src/bootstrap.php';
require_login();

$pdo = get_db();

// Validate input
$exerciseId = $_POST['exercise_id'] ?? null;
$reps = $_POST['reps'] ?? null;
$weight = $_POST['weight'] ?? null;

if (!$exerciseId || !$reps || !$weight) {
    die("Invalid input.");
}

// Verify ownership (via join)
$stmt = $pdo->prepare("
    SELECT w.id AS workout_id
    FROM exercises e
    JOIN workouts w ON e.workout_id = w.id
    WHERE e.id = ? AND w.user_id =?
");
$stmt->execute([$exerciseId, $_SESSION['user_id']]);

$result = $stmt->fetch();

if (!$result) {
    die("Unauthorized.");
}

$workoutId = $result['workout_id'];

// Insert set
$stmt = $pdo->prepare("
    INSERT INTO sets (exercise_id, reps, weight)
    VALUES (?, ?, ?)
    ");
$stmt->execute([$exerciseId, $reps, $weight]);

// Redirect back to workout
header("Location: /workout.php?id=" . $workoutId);
exit;
