<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();

$title = "Dashboard";

// Start output buffering
ob_start();
?>

<?php
/* ── Sample data — replace with real DB queries when ready ── */
$user = [
    'first_name' => 'Alex',
    'username'   => 'alexlifts',
];

$stats = [
    ['label' => 'Total Workouts',  'value' => '48'],
    ['label' => 'This Month',      'value' => '9'],
    ['label' => 'Avg Duration',    'value' => '54 min'],
    ['label' => 'Exercises Logged','value' => '214'],
];

$recent_workouts = [
    [
        'id'               => 3,
        'title'            => 'Push Day',
        'workout_date'     => '2026-03-25',
        'duration_minutes' => 58,
        'exercises'        => [
            ['name' => 'Bench Press',     'sets' => [['reps' => 5, 'weight' => 185], ['reps' => 5, 'weight' => 195], ['reps' => 4, 'weight' => 200]]],
            ['name' => 'Overhead Press',  'sets' => [['reps' => 8, 'weight' => 115], ['reps' => 7, 'weight' => 115], ['reps' => 6, 'weight' => 115]]],
            ['name' => 'Incline Dumbbell','sets' => [['reps' => 10, 'weight' => 70], ['reps' => 9, 'weight' => 70]]],
        ],
    ],
    [
        'id'               => 2,
        'title'            => 'Pull Day',
        'workout_date'     => '2026-03-23',
        'duration_minutes' => 62,
        'exercises'        => [
            ['name' => 'Deadlift',         'sets' => [['reps' => 3, 'weight' => 315], ['reps' => 3, 'weight' => 325]]],
            ['name' => 'Barbell Row',      'sets' => [['reps' => 8, 'weight' => 155], ['reps' => 8, 'weight' => 155]]],
            ['name' => 'Pull-ups',         'sets' => [['reps' => 10, 'weight' => 0],  ['reps' => 9, 'weight' => 0]]],
        ],
    ],
    [
        'id'               => 1,
        'title'            => 'Leg Day',
        'workout_date'     => '2026-03-21',
        'duration_minutes' => 70,
        'exercises'        => [
            ['name' => 'Squat',            'sets' => [['reps' => 5, 'weight' => 245], ['reps' => 5, 'weight' => 255], ['reps' => 4, 'weight' => 260]]],
            ['name' => 'Romanian Deadlift','sets' => [['reps' => 8, 'weight' => 185], ['reps' => 8, 'weight' => 185]]],
            ['name' => 'Leg Press',        'sets' => [['reps' => 12, 'weight' => 360],['reps' => 10, 'weight' => 380]]],
        ],
    ],
];

$personal_records = [
    ['exercise' => 'Squat',         'weight' => 260, 'reps' => 4, 'date' => '2026-03-21'],
    ['exercise' => 'Bench Press',   'weight' => 200, 'reps' => 4, 'date' => '2026-03-25'],
    ['exercise' => 'Deadlift',      'weight' => 325, 'reps' => 3, 'date' => '2026-03-23'],
    ['exercise' => 'Overhead Press','weight' => 115, 'reps' => 6, 'date' => '2026-03-25'],
];
?>

<div class="dashboard container">

    <!-- Welcome -->
    <div class="dash-welcome">
        <div>
            <h1 class="dash-welcome__heading">Welcome back, <?= htmlspecialchars($user['first_name']) ?>.</h1>
            <p class="dash-welcome__sub">You're on a roll. Keep stacking those plates.</p>
        </div>
        <a href="/workout.php" class="btn btn--primary">+ Log Workout</a>
    </div>

    <!-- Stats Row -->
    <div class="dash-stats">
        <?php foreach ($stats as $stat): ?>
        <div class="stat-card">
            <span class="stat-card__value"><?= htmlspecialchars($stat['value']) ?></span>
            <span class="stat-card__label"><?= htmlspecialchars($stat['label']) ?></span>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Main grid: recent workouts + sidebar -->
    <div class="dash-grid">

        <!-- Recent Workouts -->
        <section class="dash-section">
            <div class="dash-section__header">
                <h2 class="dash-section__title">Recent Workouts</h2>
                <a href="/workout.php" class="dash-section__link">View all &rarr;</a>
            </div>

            <div class="workout-list">
                <?php foreach ($recent_workouts as $workout): ?>
                <div class="workout-card">
                    <div class="workout-card__header">
                        <div>
                            <h3 class="workout-card__title"><?= htmlspecialchars($workout['title']) ?></h3>
                            <p class="workout-card__meta">
                                <?= date('M j, Y', strtotime($workout['workout_date'])) ?>
                                &middot;
                                <?= (int)$workout['duration_minutes'] ?> min
                                &middot;
                                <?= count($workout['exercises']) ?> exercises
                            </p>
                        </div>
                        <a href="/workout.php?id=<?= (int)$workout['id'] ?>" class="workout-card__btn">View</a>
                    </div>

                    <div class="exercise-table-wrap">
                        <table class="exercise-table">
                            <thead>
                                <tr>
                                    <th>Exercise</th>
                                    <th>Sets</th>
                                    <th>Best Set</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($workout['exercises'] as $ex): ?>
                                <?php
                                    $best = array_reduce($ex['sets'], function($carry, $s) {
                                        return ($carry === null || $s['weight'] > $carry['weight']) ? $s : $carry;
                                    }, null);
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($ex['name']) ?></td>
                                    <td><?= count($ex['sets']) ?></td>
                                    <td>
                                        <?php if ($best['weight'] > 0): ?>
                                            <?= $best['reps'] ?> &times; <?= $best['weight'] ?> lb
                                        <?php else: ?>
                                            <?= $best['reps'] ?> reps (BW)
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Sidebar -->
        <aside class="dash-sidebar">

            <!-- Personal Records -->
            <section class="dash-section">
                <div class="dash-section__header">
                    <h2 class="dash-section__title">Personal Records</h2>
                </div>
                <ul class="pr-list">
                    <?php foreach ($personal_records as $pr): ?>
                    <li class="pr-item">
                        <div class="pr-item__left">
                            <span class="pr-item__exercise"><?= htmlspecialchars($pr['exercise']) ?></span>
                            <span class="pr-item__date"><?= date('M j', strtotime($pr['date'])) ?></span>
                        </div>
                        <span class="pr-item__weight"><?= $pr['weight'] ?> <small>lb</small></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <!-- Quick Log CTA -->
            <section class="quick-log-card">
                <div class="quick-log-card__icon">🏋️</div>
                <h3>Ready to train?</h3>
                <p>Log today's session and keep the streak alive.</p>
                <a href="/workout.php" class="btn btn--primary" style="width:100%; text-align:center;">Start Workout</a>
            </section>

        </aside>
    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../views/layout.php';

