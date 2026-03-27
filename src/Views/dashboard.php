<div class="dashboard container">

    <!-- Welcome -->
    <div class="dash-welcome">
        <div>
            <h1 class="dash-welcome__heading">Welcome back, <?= htmlspecialchars($user['first_name']) ?>.</h1>
            <p class="dash-welcome__sub">You're on a roll. Keep stacking those plates.</p>
        </div>
        <form method="POST" action="/actions/add_workout.php">
            <button class="btn btn--primary">+ Log Workout</button>
        </form>
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
