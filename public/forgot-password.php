<?php require __DIR__ . '/../src/bootstrap.php';

$title = "Forgot Password";

ob_start();
?>

<div class="container">
    <h1>Forgot Password</h1>
    <div class="form__container">
    <form action="/actions/password_reset.php" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        <div>
        <button type="submit">Send Password Reset</button>
    </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../src/Views/layout.php';

