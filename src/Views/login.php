<div class="container">
<h1>Login Page</h1>
    <div class="form__container">
    <form method="POST" action="/login">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <div>
        <a href="/register">Register</a>
        <a href="/forgot-password">Forgot Password</a>
    </div>
    </div>
    <?php if (!empty($error)): ?>
        <div class="form-errors">
            <?=htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
</div>
