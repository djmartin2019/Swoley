<?php
require __DIR__ . '/../src/bootstrap.php';
require_login();

$title = "Workout";

ob_start();
?>

<div class="container">
    <h1>Workouts</h1>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../views/layout.php';
