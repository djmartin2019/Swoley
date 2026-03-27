<?php

class DashboardController
{
    public function index()
    {
        global $loggedIn;

        require_login();

        $title = "Dashboard";

        $user = [
            'first_name' => 'Davey',
            'username'   => 'djmartin2019',
        ];

        $stats = [
            ['label' => 'Total Workouts',   'value' => '48'],
            ['label' => 'This Month',       'value' => '9'],
            ['label' => 'Avg Duration',     'value' => '54 min'],
            ['label' => 'Exercises Logged', 'value' => '214'],
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
                    ['name' => 'Incline Dumbbell','sets' => [['reps' => 10, 'weight' => 70],  ['reps' => 9, 'weight' => 70]]],
                ],
            ],
            [
                'id'               => 2,
                'title'            => 'Pull Day',
                'workout_date'     => '2026-03-23',
                'duration_minutes' => 62,
                'exercises'        => [
                    ['name' => 'Deadlift',    'sets' => [['reps' => 3, 'weight' => 315], ['reps' => 3, 'weight' => 325]]],
                    ['name' => 'Barbell Row', 'sets' => [['reps' => 8, 'weight' => 155], ['reps' => 8, 'weight' => 155]]],
                    ['name' => 'Pull-ups',    'sets' => [['reps' => 10, 'weight' => 0],  ['reps' => 9, 'weight' => 0]]],
                ],
            ],
            [
                'id'               => 1,
                'title'            => 'Leg Day',
                'workout_date'     => '2026-03-21',
                'duration_minutes' => 70,
                'exercises'        => [
                    ['name' => 'Squat',             'sets' => [['reps' => 5, 'weight' => 245], ['reps' => 5, 'weight' => 255], ['reps' => 4, 'weight' => 260]]],
                    ['name' => 'Romanian Deadlift', 'sets' => [['reps' => 8, 'weight' => 185], ['reps' => 8, 'weight' => 185]]],
                    ['name' => 'Leg Press',         'sets' => [['reps' => 12, 'weight' => 360], ['reps' => 10, 'weight' => 380]]],
                ],
            ],
        ];

        $personal_records = [
            ['exercise' => 'Squat',          'weight' => 260, 'reps' => 4, 'date' => '2026-03-21'],
            ['exercise' => 'Bench Press',    'weight' => 200, 'reps' => 4, 'date' => '2026-03-25'],
            ['exercise' => 'Deadlift',       'weight' => 325, 'reps' => 3, 'date' => '2026-03-23'],
            ['exercise' => 'Overhead Press', 'weight' => 115, 'reps' => 6, 'date' => '2026-03-25'],
        ];

        ob_start();
        require __DIR__ . '/../Views/dashboard.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layout.php';
    }
}
