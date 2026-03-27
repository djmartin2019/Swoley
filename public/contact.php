<?php
require __DIR__ . '/../src/bootstrap.php';

$title = "Contact";

ob_start();
?>

<?php
$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')    $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
    if ($subject === '') $errors[] = 'Subject is required.';
    if (strlen($message) < 10) $errors[] = 'Message must be at least 10 characters.';

    if (empty($errors)) {
        /* Mail sending goes here when ready */
        $success = true;
    }
}
?>

<div class="contact-page container">

    <!-- Left: copy + info -->
    <div class="contact-info">
        <p class="hero__eyebrow">Get In Touch</p>
        <h1 class="contact-info__headline">We'd love to hear from you.</h1>
        <p class="contact-info__sub">
            Have a feature request, bug report, or just want to say hey?
            Drop us a message and we'll get back to you as soon as we can.
        </p>

        <ul class="contact-details">
            <li class="contact-detail">
                <span class="contact-detail__icon">👤</span>
                <div>
                    <span class="contact-detail__label">Creator</span>
                    <span class="contact-detail__value">David Martin</span>
                </div>
            </li>
            <li class="contact-detail">
                <span class="contact-detail__icon">✉️</span>
                <div>
                    <span class="contact-detail__label">Email</span>
                    <a class="contact-detail__value contact-detail__value--link"
                       href="mailto:djmartindev@gmail.com">djmartindev@gmail.com</a>
                </div>
            </li>
            <li class="contact-detail">
                <span class="contact-detail__icon">🐙</span>
                <div>
                    <span class="contact-detail__label">GitHub</span>
                    <a class="contact-detail__value contact-detail__value--link"
                       href="https://github.com" target="_blank" rel="noopener">github.com/swoley</a>
                </div>
            </li>
        </ul>

        <div class="contact-response-note">
            <span class="contact-response-note__dot"></span>
            Typically responds within 48 hours
        </div>
    </div>

    <!-- Right: form -->
    <div class="contact-form-wrap">

        <?php if ($success): ?>
        <div class="contact-success">
            <span class="contact-success__icon">✓</span>
            <h2>Message sent!</h2>
            <p>Thanks for reaching out. We'll be in touch soon.</p>
            <a href="/contact.php" class="btn btn--ghost" style="margin-top:0.5rem;">Send another</a>
        </div>

        <?php else: ?>

        <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <strong>Please fix the following:</strong>
            <ul>
                <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form class="contact-form" method="POST" action="/contact.php" novalidate>
            <div class="form-row form-row--two">
                <div class="form-field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name"
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                           placeholder="Your name" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                           placeholder="you@example.com" required>
                </div>
            </div>

            <div class="form-field">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject"
                       value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"
                       placeholder="What's this about?" required>
            </div>

            <div class="form-field">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6"
                          placeholder="Tell us what's on your mind..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn--primary contact-form__submit">Send Message</button>
        </form>

        <?php endif; ?>
    </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../src/Views/layout.php';
