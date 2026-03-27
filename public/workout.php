<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();

$pdo = get_db();

$workoutId = $_GET['id'] ?? null;

if (!$workoutId) {
    die("Workout not found.");
}

// Fetch workout (ensure it belongs to user)
$stmt = $pdo->prepare("
    SELECT * FROM workouts
    WHERE id = ? AND user_id =?
    ");
$stmt->execute([$workoutId, $_SESSION['user_id']]);
$workout = $stmt->fetch();

if (!$workout) {
    die("Workout not found.");
}

// Fetch exercises
$stmt = $pdo->prepare("
    SELECT * FROM exercises
    WHERE workout_id = ?
    ORDER BY id ASC
");
$stmt->execute([$workoutId]);
$exercises = $stmt->fetchAll();

$exerciseIds = array_column($exercises, 'id');

$setsByExercise = [];

if (!empty($exerciseIds)) {
    $in = implode(',', array_fill(0, count($exerciseIds), '?'));

    $stmt = $pdo->prepare("
        SELECT * FROM sets
        WHERE exercise_id IN ($in)
        ORDER BY id ASC
    ");
    $stmt->execute($exerciseIds);
    $sets = $stmt->fetchAll();

    foreach ($sets as $set) {
        $setsByExercise[$set['exercise_id']][] = $set;
    }
}

$title = htmlspecialchars($workout['title'] ?? 'Workout');

ob_start();
?>

<div class="dashboard">

    <!-- Header -->
    <div class="dash-welcome">
        <div>
            <h1 class="dash-welcome__heading">
                <?= htmlspecialchars($workout['title'] ?? 'Workout') ?>
            </h1>
            <p class="dash-welcome__sub">
                <?= htmlspecialchars($workout['workout_date']) ?>
                <?php if ($workout['duration_minutes']): ?>
                    • <?= $workout['duration_minutes'] ?> min
                <?php endif; ?>
            </p>
        </div>

        <a href="/dashboard.php" class="btn btn--ghost"><- Back</a>
    </div>

    <!-- Add Exercise -->
    <div class="form__container">
        <form method="POST" action="/actions/add_exercise.php">
            <input type="hidden" name="workout_id" value="<?= $workoutId ?>">

            <div>
                <label>Exercise Name</label>
                <input type="text" name="name" placeholder="e.g. Bench Press" required>
            </div>

            <button type="submit">+ Add Exercise</button>
        </form>
    </div>

    <!-- Exercises -->
    <div class="workout-list">
        <?php if (empty($exercises)): ?>
            <p>No exercises yet. Add one to get started!</p>
        <?php endif; ?>

        <?php foreach($exercises as $exercise): ?>
            <div class="workout-card">

                <!-- Exercise Header -->
                <div class="workout-card__header">
                    <div>
                        <h3 class="workout-card__title">
                            <?= htmlspecialchars($exercise['name']) ?>
                        </h3>
                    </div>
                </div>

                <!-- Sets Table -->
                <div class="exercise-table-wrap">
                    <table class="exercise-table">
                        <thead>
                            <tr>
                                <th>Reps</th>
                                <th>Weight</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($setsByExercise[$exercise['id']])): ?>
                                <?php foreach ($setsByExercise[$exercise['id']] as $set): ?>
                                    <tr>
                                        <td><?= $set['reps'] ?></td>
                                        <td><?= $set['weight'] ?></td>
                                    <tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No Sets Yet</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Add Set -->
                <div class="form__container">
                    <form method="POST" action="/actions/add_set.php">
                        <input type="hidden" name="exercise_id" value="<?= $exercise['id'] ?>">

                        <div>
                            <label>Reps</label>
                            <input type="number" name="reps" required>
                        </div>

                        <div>
                            <label>Weight</label>
                            <input type="number" name="weight" required>
                        </div>

                        <button type="submit" class="btn btn--primary">
                            + Add Set
                        </button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../src/Views/layout.php';

